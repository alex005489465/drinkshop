<?php

use App\Shop\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('order')
    ->group(function () {
        Route::get('/products', [OrderController::class, 'index'])
            ->name('shop.products.index');
    });