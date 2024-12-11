<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderDetailController;

Route::apiResource('order-details', OrderDetailController::class);
