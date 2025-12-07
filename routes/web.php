<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController as ControllersOrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TypesenseSetupController;
use App\Http\Controllers\UserCategoryController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\UserProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', HomeController::class)->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::resource('/cart', CartController::class);
Route::get('/register', RegisterController::class)->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', LoginController::class)->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/products', [UserProductController::class, 'index'])->name('user.products');
Route::get('/products/{product}', [UserProductController::class, 'show'])->name('user.product.show');
Route::resource('/checkout', CheckoutController::class)->middleware('auth');
Route::resource('/user/order', ControllersOrderController::class);
Route::get('/user/profile', function () {
    return view('profile');
})->name('profile');
// Route::get('/typesense/setup', [TypesenseSetupController::class, 'setup']);
// Route::get('/typesense/reindex', [TypesenseSetupController::class, 'reindex']);
Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.apply-coupon');
Route::post('/checkout/remove-coupon', [CheckoutController::class, 'removeCoupon'])->name('checkout.remove-coupon');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::resource('/admin/users', UserController::class);
    Route::resource('/admin/categories', CategoryController::class);
    Route::resource('/admin/products', ProductController::class);
    Route::resource('/admin/orders', OrderController::class);
    Route::resource('/admin/payments', PaymentController::class);
    Route::put('/admin/payments/{payment}/gen', [PaymentController::class, 'randomGen'])->name('payments.randomGen');
    Route::resource('/admin/users/{user}/addresses', AddressController::class);
    Route::resource('/admin/orders/{order}/order_items', OrderItemController::class);
});



Route::get('/users', function () {
    return view('users.dashboard');
})->name('users');

Route::get('esewa-callback', [CheckoutController::class, 'esewaCallback'])->name('esewa.callback');


// routes/web.php
Route::get('/test-email', function () {
    $user = (object) [
        'name' => 'Test User',
        'email' => 'test@example.com'
    ];

    \Mail::to($user->email)->send(new \App\Mail\WelcomeEmail($user));
    
    return 'Test email sent to Mailtrap!';
});
// Email Verification Routes
use App\Http\Controllers\Auth\VerificationController;

Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// Password Reset Routes
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/password/reset', [ResetPasswordController::class, 'reset'])
    ->middleware('guest')
    ->name('password.update');
