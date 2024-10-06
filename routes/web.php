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

Route::get('/login', \App\Http\Controllers\Login\IndexController::class)
    ->name('login.index');
Route::post('/login', \App\Http\Controllers\Login\StoreController::class)
    ->name('login.store');

Route::get('/login/verification', \App\Http\Controllers\Login\Verification\IndexController::class)
    ->middleware('signed')
    ->name('login.verification.index');

Route::get('/logout', \App\Http\Controllers\LogoutController::class)
    ->name('logout.index');
