<?php

use Illuminate\Support\Facades\Route;

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index']);
Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'show']);
Route::post('/purchase', [\App\Http\Controllers\PurchaseController::class, 'store']);