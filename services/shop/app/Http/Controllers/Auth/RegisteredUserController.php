<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * 處理用戶註冊請求
     */
    public function store(RegisterationRequest $request): JsonResponse
    {
        // 獲取驗證過的數據
        $validated = $request->validated();

        // 創建新用戶
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 自動登入新用戶
        Auth::login($user);

        // 回傳成功響應
        return response()->json([
            'message' => "註冊成功，歡迎 {$user->name} 來到 Bliss Paradise",
            'user' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ], 201);
    }
}
