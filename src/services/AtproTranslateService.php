<?php

namespace Atpro\Translator\services;

use ErrorException;
use Illuminate\Filesystem\Filesystem;
use Stichoza\GoogleTranslate\GoogleTranslate;
use function is_dir;
use function mkdir;


class AtproTranslateService
{
    private ?GoogleTranslate $translator = null;

    private const EXT ='.php';
    private const TEST_DIRECTORY ='lang/test';
    private const LANG_DIRECTORY ='lang';



    public function __construct()
    {
        $this->translator = $this->translator == null ?  new GoogleTranslate() : $this->translator;
    }

    /***
     * This translates a multi-associative array of data from a language to another
     * @param string $from the start language
     * @param array $to the arrival language
     * @return void
     * @throws ErrorException
     * @example $tr->translate('./lang/en','./lang', $from, $to)
     * @ $array the associative array
     */
    public function translate(string $from, array $to): void
    {
        $subdirectoryName = base_path(self::LANG_DIRECTORY);
        (new Filesystem)->copyDirectory(base_path(self::LANG_DIRECTORY.DIRECTORY_SEPARATOR.$from), base_path(self::TEST_DIRECTORY));
        $directoryName = base_path(self::TEST_DIRECTORY);
        foreach ($to as $lang) {
            $this->translator->setSource($from);
            $this->translator->setTarget($lang);
            $data = [];
            $scandir = scandir($directoryName);
            foreach($scandir as $fichier){
                if($fichier != '.' and $fichier != '..'){
                    $array = require $directoryName.'\\'.$fichier;
                    foreach ($array as $key => $value)
                    {
                        if (is_array($value))
                        {
                            foreach ($value as $keyword => $item) {
                                if(is_array($item))
                                {
                                    foreach ($item as $keys => $val){
                                        $chaine =  $this->translator->translate($this->containsWords($val));
                                        $array[$key][$keyword][$keys] = '"'.$this->replaceWords($chaine).'",';
                                    }
                                }
                                else{
                                    $chaine =  $this->translator->translate($this->containsWords($item));
                                    $array[$key][$keyword] = '"'.$this->replaceWords($chaine).'",';
                                }
                            }
                        }
                        else
                        {
                            $chaine =  $this->translator->translate($this->containsWords($value));
                            $array[$key] = '"' .$this->replaceWords($chaine).'",';
                        }
                    }
                    $content =  $this->replaceInArray($array);
                    $this->makeDirectory($subdirectoryName.DIRECTORY_SEPARATOR.$lang);
                    $filename = $subdirectoryName.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.substr(strtolower($fichier),0,-4) . self::EXT;
                    $this->writeInPhpFile($filename,$content);
                }
            }
        }
    }

    /***
     * This translates a multi-associative array of data from a language to another
     * @param string $from the start language
     * @param array $to the arrival language
     * @param array $files the arrival language
     * @return void
     * @throws ErrorException
     * @example $tr->translate('./lang/en','./lang', $from, $to)
     * @ $array the associative array
     */
    public function translateList(string $from, array $to, array $listes): void
    {
        $subdirectoryName = base_path(self::LANG_DIRECTORY);
        (new Filesystem)->copyDirectory(base_path(self::LANG_DIRECTORY.DIRECTORY_SEPARATOR.$from), base_path(self::TEST_DIRECTORY));
        $directoryName = base_path(self::TEST_DIRECTORY);
        foreach ($to as $lang) {
            $this->translator->setSource($from);
            $this->translator->setTarget($lang);
            $data = [];
            $scandir = scandir($directoryName);
            foreach($listes as $fichier){
                if($fichier != '.' and $fichier != '..'){
                    $array = require $directoryName.'\\'.$fichier;
                    foreach ($array as $key => $value)
                    {
                        if (is_array($value))
                        {
                            foreach ($value as $keyword => $item) {
                                if(is_array($item))
                                {
                                    foreach ($item as $keys => $val){
                                        $chaine =  $this->translator->translate($this->containsWords($val));
                                        $array[$key][$keyword][$keys] = '"'.$this->replaceWords($chaine).'",';
                                    }
                                }
                                else{
                                    $chaine =  $this->translator->translate($this->containsWords($item));
                                    $array[$key][$keyword] = '"'.$this->replaceWords($chaine).'",';
                                }
                            }
                        }
                        else
                        {
                            $chaine =  $this->translator->translate($this->containsWords($value));
                            $array[$key] = '"' .$this->replaceWords($chaine).'",';
                        }
                    }
                    $content =  $this->replaceInArray($array);
                    $this->makeDirectory($subdirectoryName.DIRECTORY_SEPARATOR.$lang);
                    $filename = $subdirectoryName.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.substr(strtolower($fichier),0,-4) . self::EXT;
                    $this->writeInPhpFile($filename,$content);
                }
            }
        }
    }


    /***
     * This translates a multi-associative array of data from a language to another
     * @param string $from the start language
     * @param array $to the arrival language
     * @param array $files the arrival language
     * @return void
     * @throws ErrorException
     * @example $tr->translate('./lang/en','./lang', $from, $to)
     * @ $array the associative array
     */
    public function translateExept(string $from, array $to, array $listes): void
    {
        $subdirectoryName = base_path(self::LANG_DIRECTORY);
        (new Filesystem)->copyDirectory(base_path(self::LANG_DIRECTORY.DIRECTORY_SEPARATOR.$from), base_path(self::TEST_DIRECTORY));
        $directoryName = base_path(self::TEST_DIRECTORY);
        foreach ($to as $lang) {
            $this->translator->setSource($from);
            $this->translator->setTarget($lang);
            $data = [];
            $scandir = scandir($directoryName);
            foreach($scandir as $fichier){
                if($fichier != '.' and $fichier != '..' and !in_array($fichier, $listes)){
                    $array = require $directoryName.'\\'.$fichier;
                    foreach ($array as $key => $value)
                    {
                        if (is_array($value))
                        {
                            foreach ($value as $keyword => $item) {
                                if(is_array($item))
                                {
                                    foreach ($item as $keys => $val){
                                        $chaine =  $this->translator->translate($this->containsWords($val));
                                        $array[$key][$keyword][$keys] = '"'.$this->replaceWords($chaine).'",';
                                    }
                                }
                                else{
                                    $chaine =  $this->translator->translate($this->containsWords($item));
                                    $array[$key][$keyword] = '"'.$this->replaceWords($chaine).'",';
                                }
                            }
                        }
                        else
                        {
                            $chaine =  $this->translator->translate($this->containsWords($value));
                            $array[$key] = '"' .$this->replaceWords($chaine).'",';
                        }
                    }
                    $content =  $this->replaceInArray($array);
                    $this->makeDirectory($subdirectoryName.DIRECTORY_SEPARATOR.$lang);
                    $filename = $subdirectoryName.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.substr(strtolower($fichier),0,-4) . self::EXT;
                    $this->writeInPhpFile($filename,$content);
                }
            }
        }
    }
    /**
     * create a new directory if not exist
     * @param string $directoryName
     */
    public function makeDirectory(string $directoryName): void
    {
        if(!is_dir($directoryName)){
            mkdir($directoryName);
        }
    }


    /**
     * @param string $fileName
     * @param string $fileContent
     */
    private function writeInPhpFile(string $fileName, string $fileContent): void
    {
        file_put_contents($fileName, '<?php');
        $content = file_get_contents($fileName);
        $content .= "\n\n\n\n\n\n";
        $content .= 'return '.substr(rtrim($fileContent), 0, -1).';';
        file_put_contents($fileName, $content);
    }

    /**
     * @param string $chaine
     * @return string
     */
    public function containsWords(string $chaine):string
    {
        if(str_contains($chaine, ":attribute")){
            $chaine = str_replace(":attribute",  ':a', $chaine);
        }
        if(str_contains($chaine, ":value")){
            $chaine = str_replace(":value",  ':v', $chaine);
        }
        if(str_contains($chaine, "_MENU_")){
            $chaine = str_replace(":menu",  ':v', $chaine);
        }
        if(str_contains($chaine, ":min")){
            $chaine = str_replace(":min",  ':mn', $chaine);
        }
        if(str_contains($chaine, ":max")){
            $chaine = str_replace(":max",  ':mx',$chaine);
        }
        if(str_contains($chaine, ":value")){
            $chaine = str_replace(":value",  ':vl', $chaine);
        }
        if(str_contains($chaine, ":other")){
            $chaine = str_replace(":other",  ':ot', $chaine);
        }
        if(str_contains($chaine, ":size")){
            $chaine = str_replace(":size",  ':sz', $chaine);
        }
        if(str_contains($chaine, "&laquo;")){
            $chaine = str_replace("&laquo;",  ':00', $chaine);
        }
        if(str_contains($chaine, "&raquo;")){
            $chaine = str_replace("&raquo;",  ':01', $chaine);
        }
        if(str_contains($chaine, ":date")){
            $chaine = str_replace(":date",  ':d', $chaine);
        }
        if(str_contains($chaine, ":format")){
            $chaine = str_replace(":format",  ':f', $chaine);
        }
        if(str_contains($chaine, ":seconds")){
            $chaine = str_replace(":seconds",  ':s', $chaine);
        }

        return $chaine;

    }

    /**
     * @param string $chaine
     * @return string
     */
    public function replaceWords(string $chaine):string
    {
        if(str_contains($chaine, ":a")){
            $chaine = str_replace(":a",  ':attribute ', $chaine);
        }
        if(str_contains($chaine, ":v")){
            $chaine = str_replace(":v",  ':value ', $chaine);
        }
        if(str_contains($chaine, ":menu")){
            $chaine = str_replace(":menu",  '_MENU_', $chaine);
        }
        if(str_contains($chaine, ":mn")){
            $chaine = str_replace(":mn",  ':min ', $chaine);
        }
        if(str_contains($chaine, ":mx")){
            $chaine = str_replace(":mx",  ':max ',$chaine);
        }
        if(str_contains($chaine, ":vl")){
            $chaine = str_replace(":vl",  ':value ', $chaine);
        }
        if(str_contains($chaine, ":ot")){
            $chaine = str_replace(":ot",  ':other ', $chaine);
        }
        if(str_contains($chaine, ":sz")){
            $chaine = str_replace(":sz",  ':size ', $chaine);
        }
        if(str_contains($chaine, ":d")){
            $chaine = str_replace(":d",  ':date', $chaine);
        }
        if(str_contains($chaine, ":f")){
            $chaine = str_replace(":f",  ':format', $chaine);
        }
        if(str_contains($chaine, ":s")){
            $chaine = str_replace(":s",  ':seconds', $chaine);
        }
        return $chaine;

    }

    /**
     * @param array $data
     * @return array|bool|string
     */
    private function replaceInArray(array $data): array|bool|string
    {
        $content = str_replace("Array", "", print_r($data, true));
        $content = str_replace("[", "'", print_r($content, true));
        $content = str_replace("]", "'", print_r($content, true));

        $content = str_replace("(", "[", print_r($content, true));
        $content = str_replace(")", "],", print_r($content, true));

        $content = str_replace("=> '", '=> "', print_r($content, true));

        $content = str_replace("',", '",', print_r($content, true));

        $content = str_replace(":00", '&laquo;', print_r($content, true));

        return str_replace(":01", '&raquo;', print_r($content, true));
    }

    /**
     * @return void
     */
    public function deleteDirectory(): void
    {
        (new Filesystem)->cleanDirectory(base_path(self::TEST_DIRECTORY));
        (new Filesystem)->deleteDirectory(base_path(self::TEST_DIRECTORY));
    }
}
