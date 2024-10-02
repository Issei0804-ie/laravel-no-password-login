<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', \App\Http\Controllers\Register\IndexController::class);

Route::get('/email/verification', function (){})
    ->name('email.verification');
