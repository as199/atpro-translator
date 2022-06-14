<?php

namespace Atpro\Translator\services;

use Illuminate\Support\Facades\Session;

class AtproTranslatorViewService
{
    public function saveLanguages(array $languages): void
    {
        Session::put('languages', $languages);
    }
}
