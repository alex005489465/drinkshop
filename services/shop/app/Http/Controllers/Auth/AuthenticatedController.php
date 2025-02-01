<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticatedController extends Controller
{
    /**
     * 處理用戶登入請求
     */
    public function store(LoginRequest $request): JsonResponse
    {
        // 獲取驗證過的數據
        $credentials = $request->validated();

        // 嘗試登入
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // 登入成功
            return response()->json([
                'message' => '登入成功，歡迎 ' . $user->name . ' 來到 Bliss Paradise',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ]);
        }

        // 登入失敗
        return response()->json([
            'message' => '登入失敗，帳號或密碼錯誤'
        ], 401);
    }

    /**
     * 檢查用戶登入狀態
     */
    public function check(): JsonResponse
    {
        if (Auth::check()) {
            $user = Auth::user();
            return response()->json([
                'message' => 'Welcome to Drinkshop!',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ]);
        }

        return response()->json([
            'message' => '請先登入'
        ], 401);
    }

    /**
     * 處理用戶登出請求
     */
    public function destroy(): JsonResponse
    {
        // 取得當前用戶名稱
        $userName = Auth::user()->name;

        // 登出用戶
        Auth::logout();

        // 回傳成功響應
        return response()->json([
            'message' => "已登出，期待 {$userName} 再次光臨"
        ]);
    }
}
