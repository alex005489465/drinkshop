<?php

use App\Shop\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('cart')->group(function () {
    // 查看產品列表
    Route::get('/products', [CartController::class, 'index'])
            ->name('shop.products.index');
    
    Route::get('/inititems', [CartController::class, 'listitems']);

    // 查看購物車內容
    Route::get('/getitems', [CartController::class, 'show'])
            ->middleware('auth');
    
    // 新增/更新購物車內容
    Route::post('/saveitems', [CartController::class, 'store'])
            ->middleware('auth');
});