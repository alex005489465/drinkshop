<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    // 註冊路由 (僅限訪客)
    Route::post('register', [RegisteredUserController::class, 'store'])
        ->middleware('guest')
        ->name('register');

    // 登入路由 (僅限訪客)
    Route::post('login', [AuthenticatedController::class, 'store'])
        ->middleware('guest')
        ->name('login');

    // 登出路由 (需要驗證)
    Route::post('logout', [AuthenticatedController::class, 'destroy'])
        ->middleware('auth')
        ->name('logout');
        
    // 檢查登入狀態路由
    Route::post('check', [AuthenticatedController::class, 'check'])
        ->name('check');
});