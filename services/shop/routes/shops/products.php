<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\Product;
use App\Http\Controllers\Product\CategoryController;

Route::get('/list', [Product::class, 'list']);
Route::get('/description', [Product::class, 'description']);

//Route::post('/categories', [CategoryController::class, 'store']);
//Route::get('/categories/{id}', [CategoryController::class, 'show']);
//Route::put('/categories/{id}', [CategoryController::class, 'update']);
//Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
