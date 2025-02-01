<?php

use App\Http\Controllers\Shop\ShopUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->middleware(['auth'])->group(function () {
    // 獲取用戶檔案資料
    Route::get('profile', [ShopUserController::class, 'getUserProfile'])
        ->name('user.profile');

    // 獲取會員明細資料
    Route::get('member', [ShopUserController::class, 'getMemberDetails'])
        ->name('user.member');
        
    // 更新用戶檔案資料
    Route::post('profile', [ShopUserController::class, 'updateUserProfile'])
        ->name('user.profile.update');
});