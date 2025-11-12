<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',RegisterController::class);
Route::post('/register',[RegisterController::class,'register'])->name('register');

Route::get('/login',LoginController::class);
Route::post('/login',[LoginController::class,'login'])->name('login');