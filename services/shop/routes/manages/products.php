<?php

use App\Manage\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])
        ->name('products.index');
        
    Route::post('/', [ProductController::class, 'store'])
        ->name('products.store');
        
    Route::get('/show', [ProductController::class, 'show'])
        ->name('products.show');
        
    Route::post('/update', [ProductController::class, 'update'])
        ->name('products.update');
        
    Route::post('/delete', [ProductController::class, 'destroy'])
        ->name('products.destroy');
});
