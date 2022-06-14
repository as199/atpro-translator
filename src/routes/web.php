<?php


use Atpro\Translator\App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::group(['namespace' => 'Atpro\Translator\App\Http\Controllers'], function(){
    Route::post('/atpro-internalisation', [Controller::class, 'atproTranslate'])->name('atpro-internalisation');
});


