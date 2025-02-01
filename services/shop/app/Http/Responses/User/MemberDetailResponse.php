<?php

namespace App\Http\Responses\User;

use Illuminate\Http\JsonResponse;
use App\Models\ShopUser\MemberDetail;

class MemberDetailResponse extends JsonResponse
{
    public static function success(MemberDetail $memberDetails): JsonResponse
    {
        return response()->json([
            'message' => '成功獲取會員資料',
            'data' => [
                // 會員資料
                'points_balance' => $memberDetails->points_balance,
                'membership_level' => $memberDetails->membership_level,
                'points_expire_at' => $memberDetails->points_expire_at,
                'last_activity_at' => $memberDetails->last_activity_at
            ]
        ]);
    }

    public static function notFound(): JsonResponse
    {
        return response()->json([
            'message' => '找不到會員資料'
        ], 404);
    }

    public static function error(): JsonResponse
    {
        return response()->json([
            'message' => '獲取會員資料失敗'
        ], 500);
    }
}