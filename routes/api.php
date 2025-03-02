<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainApiController;
use App\Http\Controllers\CartController;

//Маршруты для API
Route::get('/best-products', [MainApiController::class, 'getBestProducts'])->name('api.best-products');
Route::get('/best-products', [MainApiController::class, 'getBestProducts'])->name('api.best-products');
Route::get('/discount-products', [MainApiController::class, 'getDiscountProducts'])->name('api.discount-products');
Route::get('/random-products', [MainApiController::class, 'getRandomProducts'])->name('api.random-products');
Route::get('/shop-products/{categoryId}', [MainApiController::class, 'getShopProducts'])->name('api.shop-products');
Route::get('/product/{id}', [MainApiController::class, 'getAllAboutProduct'])->name('api.product-info');
