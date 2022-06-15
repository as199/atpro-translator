<?php


use Atpro\Translator\App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

 Route::post('/atpro-internalisation', [Controller::class, 'atproTranslate'])->name('atpro-internalisation');



