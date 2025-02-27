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

Route::view('/carts', 'shop/carts')
    ->name('carts');

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';