<?php

namespace Atpro\Translator\App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Language extends Component
{
    public string $languages;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->languages = $this->getLanguages(Session::get("languages"));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        return view('atpro::components.language');
    }

    /**
     * @param array $datas
     * @return array
     */
    private function getLanguages(array $datas): array
    {
        $count = 0;
        $result = [];
        foreach ($datas as  $item) {

            $result[$count]['code'] = $item;
            $result[$count]['lang'] = $this->getLanguageName($item);
            $result[$count]['icon'] = $this->getIcon($item);
       }
    }

    private function getIcon(string $code): string
    {
        return( strtolower($code) === 'en')?'flag-icon flag-icon-us':'flag-icon flag-icon-'.strtolower($code);
    }
    private function getLanguageName(string $code): string
    {
        return match (strtolower($code)) {
            'en' => "English",
            'fr' => "French",
            'es' => "Spanish",
            'de' => "German",
            'it' => "Italian",
        };
    }
}
