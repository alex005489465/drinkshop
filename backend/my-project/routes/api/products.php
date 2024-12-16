<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductlistController;

Route::get('products', [ProductlistController::class, 'list']);
Route::get('products/{product}', [ProductController::class, 'show']);
Route::get('products/search', [ProductController::class, 'search']);
