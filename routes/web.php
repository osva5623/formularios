<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\formulariosController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/formularios/{usuario}', [formulariosController::class,'index'])->name('formularios');
