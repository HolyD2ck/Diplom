<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
//Route::apiResource('products', \App\Http\Controllers\ProductController::class)->only(['index', 'show']);
Route::get('/products', [\App\Http\Controllers\MainApiController::class, 'getAllInfoProduct']);
Route::get('/product/{id}', [\App\Http\Controllers\MainApiController::class, 'getReviewsForProduct']);
require __DIR__ . '/auth.php';
