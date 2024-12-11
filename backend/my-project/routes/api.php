<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Include additional API route files
require __DIR__.'/api/products.php';
require __DIR__.'/api/orders.php';
require __DIR__.'/api/order_details.php';
require __DIR__.'/api/payments.php';
require __DIR__.'/api/shipments.php';