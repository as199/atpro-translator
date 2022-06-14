<?php

namespace Atpro\Translator\App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function atproTranslate(Request $request): RedirectResponse
    {

        $lang = $request->get('lang');
        Session::put('lang', $lang);
        Session::put('country', $this->getCountry($lang));
        App::setLocale($lang);
        return back();
    }
    public function atproSaveTranslate( array $data): RedirectResponse
    {
        Session::put('languages', $data);
        return back();
    }

    public function getAtproTranslate(): RedirectResponse
    {
        dd(Session::get('languages'));
    }

    /**
     * @param string $code
     * @return string
     */
    private function getCountry(string $code): string
    {
        return match ($code) {
            'en' => "English",
            'fr' => "French",
            'es' => "Spanish",
            'de' => "German",
            'it' => "Italian",
        };
    }
}
