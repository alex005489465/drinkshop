<?php

use Illuminate\Support\Facades\Route;
use App\Shop\Controllers\OrderController;

/**
 * 訂單相關路由 (需要登入)
 * Order related routes (requires authentication)
 */
Route::prefix('order')
    ->middleware('auth')
    ->group(function () {
        /**
         * 新增訂單
         * Create new order
         * 
         * @request POST /order/submit
         * @body {
         *   cart_items: array,      // 購物車項目
         *   total_amount: number,   // 訂單總金額
         * }
         */
        Route::post('/submit', [OrderController::class, 'store']);

        /**
         * 獲取訂單列表
         * Get order list
         * 
         * @request GET /order/list
         * @response {
         *   order_number: string,   // 訂單編號
         *   total_amount: number,   // 訂單總金額
         *   status: string,         // 訂單狀態
         *   created_at: string      // 建立時間
         * }[]
         */
        Route::get('/list', [OrderController::class, 'index']);

        /**
         * 獲取訂單詳細資料
         * Get order details
         * 
         * @request POST /order/detail
         * @body {
         *   order_number: string    // 訂單編號
         * }
         * @response {
         *   order_number: string,   // 訂單編號
         *   items: array,           // 訂單項目
         *   total_amount: number    // 訂單總金額
         * }
         */
        Route::post('/detail', [OrderController::class, 'show']);
    });