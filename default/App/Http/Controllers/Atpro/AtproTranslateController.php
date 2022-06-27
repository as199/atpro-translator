<?php

namespace App\Http\Controllers\Atpro;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AtproTranslateController extends Controller
{

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

    /**
     * @param string $code
     * @return string
     */
    private function getCountry(string $code): string
    {
        return match ($code) {
            'fr' => "French",
            'es' => "Spanish",
            'de' => "German",
            'it' => "Italian",
            default => "English"
        };
    }

}
