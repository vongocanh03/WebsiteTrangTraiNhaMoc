<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;



Route::get('/', [HomeController::class, 'index']);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::get('/category/{id}', [HomeController::class, 'showCategory'])->name('category.show');
// routes/web.php
Route::post('/api/submit-order', [OrderController::class, 'submitOrder']);
