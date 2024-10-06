<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', \App\Http\Controllers\Register\IndexController::class)
    ->name('register.index');
Route::post('/register', \App\Http\Controllers\Register\StoreController::class)
    ->name('register.store');

Route::get('/register/verification', \App\Http\Controllers\Register\Verification\IndexController::class)
    ->middleware('signed')
    ->name('register.verification.index');
