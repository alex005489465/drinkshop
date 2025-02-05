<?php

use App\Shop\Controllers\CartController;
use Illuminate\Support\Facades\Route;

/**
 * 購物車相關路由
 * Cart related routes
 */
Route::prefix('cart')->group(function () {
    /**
     * 查看產品列表
     * View product list
     */
    Route::get('/products', [CartController::class, 'index'])
            ->name('shop.products.index');
    
    /**
     * 獲取菜單初始化資料
     * Get menu initialization data
     */
    Route::get('/inititems', [CartController::class, 'listitems']);

    /**
     * 查看購物車內容 (需要登入)
     * View cart contents (requires authentication)
     */
    Route::get('/getitems', [CartController::class, 'show'])
            ->middleware('auth');
    
    /**
     * 新增或更新購物車內容 (需要登入)
     * Add or update cart contents (requires authentication)
     */
    Route::post('/saveitems', [CartController::class, 'store'])
            ->middleware('auth');
});