<?php

namespace Atpro\Translator\services;

use Atpro\Translator\App\Models\AtproLanguages;

class AtproTranslatorViewService
{

    public function createView(): void
    {
        $languages = AtproLanguages::all();
        $fileContent = '';
        foreach ($languages as $language) {
            $fileContent .= $this->generateTemplate($language->code);
        }
        $this->createFile($fileContent);

    }
    private function createFile(string $fileContent): void
    {
        $fileName = (dirname(__DIR__). '/resources/views/components/atpro-internalisation.blade.php');
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
    private function getLanguageName(string $code): string
    {
        return match ($code) {
            'fr' => 'French',
            'es' => 'Spanish',
            'it' => 'Italian',
            'de' => 'German',
            default => 'English',
        };

    }
    private function getIcon(string $code): string
    {
        return ($code === "en")?'us':$code;
    }
}
