<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainApiController;


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Маршруты для страниц

Route::view('/', 'shop/index')
    ->name('dashboard');

Route::view('/contacts', 'shop/contacts')
    ->name('contacts');

Route::view('/about', 'shop/about')
    ->name('about');

Route::view('/workers', 'shop/workers')
    ->name('workers');

Route::view('/partners', 'shop/partners')
    ->name('partners');

//Маршруты для API
Route::view('/cart', 'cart')
    ->name('cart');
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
