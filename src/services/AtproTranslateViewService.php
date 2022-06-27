<?php

namespace Atpro\Translator\services;



use Atpro\Translator\Models\AtproTranslate;

class AtproTranslateViewService
{
    public function createView(): void
    {
        $viewComponentName = (dirname(__DIR__). '/resources/views/atpro-internalisation.blade.php');
        $controllerName = base_path('app/Http/Controllers/Controller.php');
        $languages = AtproTranslate::all();
        $fileContent = '';
        foreach ($languages as $language) {
            $fileContent .= $this->generateTemplate($language->code);
        }
        $this->createFile($viewComponentName, $fileContent);

    }

    /**
     * @param string $fileName
     * @param string $fileContent
     * @return void
     */
    private function createFile(string $fileName, string $fileContent): void
    {
        file_put_contents($fileName, '');
        $content = file_get_contents($fileName);
        $content .= $fileContent;
        file_put_contents($fileName, $content);
    }


    private function generateTemplate(string $langue): string
    {
        return sprintf('<div>
                <form class="btn"  method="POST" action="%s"> @csrf
                    <input type="hidden" name="lang" value="%s">
                    <button type="submit" class="btn btn-sm"><i class="flag-icon flag-icon-%s" title="%s" id="%s"></i>%s</button>
                </form>
            </div>','/atpro-internalisation',$langue,$this->getIcon($langue),$langue,$langue, $this->getLanguageName($langue));

    }

    /**
     * @param string $code
     * @return string
     */
    private function getLanguageName(string $code): string
    {
        return match ($code) {
            'fr' => 'French',
            'es' => 'Spanish',
            'it' => 'Italian',
            'de' => 'German',
            'pt' => 'Portuguese',
            'zh' => 'Chinese',
            'hi' => 'Hindi',
            default => 'English',
        };

    }

    /**
     * @param string $code
     * @return string
     */
    private function getIcon(string $code): string
    {
        return ($code === "en")?'us':$code;
    }
}