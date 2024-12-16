<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderCreatorController;

//Route::apiResource('orders', OrderController::class);
Route::get('orders/list', [OrderController::class, 'getOrderIdsByUserId']);
Route::post('orders/create', [OrderCreatorController::class, 'createOrder']);