<?php

use App\Shop\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('cart')->group(function () {
    // 查看購物車內容
    Route::get('/items', [CartController::class, 'show']);
    
    // 新增/更新購物車內容
    Route::post('/items', [CartController::class, 'store']);
    
    // 清空購物車內容
    Route::post('/clear', [CartController::class, 'destroy']);
});