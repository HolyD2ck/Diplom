<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainApiController;
use App\Http\Controllers\CartController;
//Маршруты для API
Route::get('/products', [MainApiController::class, 'getAllInfoProduct']);
Route::get('/random-products', [MainApiController::class, 'getRandomProducts'])->name('api.random-products');
Route::get('/product/{id}', [MainApiController::class, 'getReviewsForProduct']);
Route::view('/cart', 'shop/cart')
    ->name('cart');

Route::get('/test', function () {
    return view('test');
});
Route::withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::post('/cart/remove', [CartController::class, 'removeFromCart']);
    Route::post('/cart/clear', [CartController::class, 'clearCart']);
    Route::get('/cart', [CartController::class, 'getCart']);
});