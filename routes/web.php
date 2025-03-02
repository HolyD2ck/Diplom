<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainApiController;
use App\Livewire\CategoryProducts;

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

Route::get('/category/{categoryId}', function ($categoryId) {
    return view('shop.category', ['categoryId' => $categoryId]);
})->name('category');

Route::get('/show/{productId}', function ($productId) {
    return view('shop.show', ['productId' => $productId]);
})->name('show');

//Маршруты корзины
Route::get('/cart', [CartController::class, 'getCart'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';