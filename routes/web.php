<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', \App\Http\Controllers\Register\IndexController::class);
Route::post('/register', \App\Http\Controllers\Register\StoreController::class)
    ->name('register.store');

Route::get('/email/verification', function (){})
    ->name('email.verification');
