<?php


use App\Http\Controllers\Atpro\AtproTranslateController;
use Illuminate\Support\Facades\Route;

 Route::post('/atpro-internalisation', [AtproTranslateController::class, 'atproTranslate'])->name('atpro-internalisation');



