<?php

namespace App\Http\Responses\User;

use Illuminate\Http\JsonResponse;
use App\Models\ShopUser\UserProfile;

class UserProfileResponse extends JsonResponse
{
    /**
     * 返回成功獲取用戶資料的回應
     * 
     * @param UserProfile $userProfile 用戶資料
     * @return JsonResponse
     */
    public static function success(UserProfile $userProfile): JsonResponse
    {
        return response()->json([
            'message' => '成功獲取用戶資料',
            'data' => [
                // 基本識別資料
                'user_name' => $userProfile->user_name,
                'nickname' => $userProfile->nickname,
                
                // 個人基本資料
                'gender' => $userProfile->gender,
                'birthdate' => $userProfile->birthdate,
                'nationality' => $userProfile->nationality,
                'id_number' => $userProfile->id_number,
                'notes' => $userProfile->notes,
                
                // 聯絡資訊
                'user_email' => $userProfile->user_email,
                'backup_email' => $userProfile->backup_email,
                'phone' => $userProfile->phone,
                'residential_address' => $userProfile->residential_address,
                'mailing_address' => $userProfile->mailing_address
            ]
        ]);
    }

    /**
     * 返回找不到用戶資料的錯誤回應
     * 
     * @return JsonResponse
     */
    public static function notFound(): JsonResponse
    {
        return response()->json([
            'message' => '找不到用戶資料'
        ], 404);
    }

    /**
     * 返回系統錯誤的回應
     * 
     * @return JsonResponse
     */
    public static function error(): JsonResponse
    {
        return response()->json([
            'message' => '獲取用戶資料失敗'
        ], 500);
    }

    /**
     * 返回主要電子郵件不符合當前用戶的錯誤回應
     * 
     * @return JsonResponse
     */
    public static function emailMismatch(): JsonResponse
    {
        return response()->json([
            'message' => '主要電子郵件不符合當前用戶'
        ], 400);
    }
}