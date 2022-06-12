<?php

namespace Atpro\Translator\services;

use Illuminate\Support\Facades\Session;

class AtproTranlatorViewService
{
    public function saveLanguages(array $languages): void
    {
        Session::put('languages', $languages);
    }
}
