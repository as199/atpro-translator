<?php

namespace Atpro\Translator\App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

class Current extends Component
{
    public array $result = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $code)
    {
        dd($code);
        $this->result = $this->getLanguageName($code);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        return view('atpro::components.current');
    }

    /**
     * @param string $code
     * @return array
     */
    private function getLanguageName(string $code): array
    {
        $link = $code??'en';
        switch ($link){
            case $link ==='en':
                $classes = 'flag-icon flag-icon-us';
                $slot = 'English';
                break;
            case $link ==='fr':
                $classes = 'flag-icon flag-icon-fr';
                $slot = 'French';
                break;
            case $link ==='it':
                $classes = 'flag-icon flag-icon-it';
                $slot = 'Italian';
                break;
            case $link ==='es':
                $classes = 'flag-icon flag-icon-es';
                $slot = 'Spanish';
                break;
            case $link ==='de':
                $classes = 'flag-icon flag-icon-de';
                $slot = 'German';
                break;
            default:
                $classes = 'flag-icon flag-icon-en';
                $slot = 'English';
                break;
        }
        $data["classes"] = $classes;
        $data["name"] = $slot;
        dd($data);
        return $data;
    }
}
