<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::apiResource('products', \App\Http\Controllers\ProductController::class)->only(['index', 'show']);

require __DIR__ . '/auth.php';
