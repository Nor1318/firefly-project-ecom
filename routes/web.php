<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', HomeController::class)->name('home');
Route::get('/register', RegisterController::class)->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', LoginController::class)->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::resource('/admin/users', UserController::class);
    Route::resource('/admin/categories', CategoryController::class);
    Route::resource('/admin/products', ProductController::class);
    Route::resource('/admin/orders', OrderController::class);
    Route::resource('/admin/payments', PaymentController::class);
    Route::resource('/admin/users/{user}/addresses', AddressController::class);
});
Route::get('/users', function () {
    return view('users.dashboard');
})->name('users');
