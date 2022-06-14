<?php

namespace Atpro\Translator\App\View\Components;

use Atpro\Translator\App\Models\AtproLanguages;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Language extends Component
{
    public array $languages;
    public Collection $data;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->data = AtproLanguages::all();
        $this->languages = $this->getLanguage();
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

    public function getLanguage(): array
    {
        $i = 0;
        $languages = [];
        foreach($this->data as  $value){
            $languages[$i]['code'] = $value;
            $languages[$i]['icon'] = $this->getIcon($value);
            $languages[$i]['name'] = $this->getLanguageName($value);
            $i++;
        }
        return $languages;
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
