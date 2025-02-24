<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainApiController;

Route::view('/', 'home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/products', [MainApiController::class, 'getAllInfoProduct']);
Route::get('/product/{id}', [MainApiController::class, 'getReviewsForProduct']);

Route::get('/test', function () {
    return view('test');
});

Route::withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::post('/cart/remove', [CartController::class, 'removeFromCart']);
    Route::post('/cart/clear', [CartController::class, 'clearCart']);
    Route::get('/cart', [CartController::class, 'getCart']);
});
require __DIR__ . '/auth.php';
