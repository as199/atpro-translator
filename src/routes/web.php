<?php

use Atpro\Translator\App\Http\Controllers;



Route::get('/atpro-internalisation', function(){
    return 'assane';
});
Route::post('/atpro-internalisation', [Controller::class, 'atproTranslate'])->name('atpro-internalisation');
