<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\ShopUser\UserProfile;
use App\Models\ShopUser\MemberDetail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\User\UserProfileResponse;
use App\Http\Responses\User\MemberDetailResponse;
use App\Http\Requests\User\UserProfileUpdateRequest;

class ShopUserController extends Controller
{
    /**
     * 獲取用戶檔案資料
     * 
     * 根據當前登入用戶的ID查找對應的個人檔案資料
     * 如果找不到資料則返回404錯誤
     * 
     * @param Request $request 請求對象，包含已認證的用戶信息
     * @return JsonResponse 返回JSON格式的用戶資料
     */
    public function getUserProfile(Request $request): JsonResponse
    {
        try {
            // 查找當前用戶的檔案資料
            $userProfile = UserProfile::where('user_id', $request->user()->id)->first();
            
            // 如果找不到用戶資料，返回404錯誤
            if (!$userProfile) {
                return UserProfileResponse::notFound();
            }

            // 返回成功獲取的用戶資料
            return UserProfileResponse::success($userProfile);
        } catch (\Exception $e) {
            return UserProfileResponse::error();
        }
    }

    /**
     * 獲取會員明細資料
     * 
     * 根據當前登入用戶的ID查找對應的會員明細資料
     * 如果找不到資料則返回404錯誤
     * 
     * @param Request $request 請求對象，包含已認證的用戶信息
     * @return JsonResponse 返回JSON格式的會員資料
     */
    public function getMemberDetails(Request $request): JsonResponse
    {
        try {
            // 查找當前用戶的會員資料
            $memberDetails = MemberDetail::where('user_id', $request->user()->id)->first();
            
            // 如果找不到會員資料，返回404錯誤
            if (!$memberDetails) {
                return MemberDetailResponse::notFound();
            }

            // 返回成功獲取的會員資料
            return MemberDetailResponse::success($memberDetails);
        } catch (\Exception $e) {
            return MemberDetailResponse::error();
        }
    }

    /**
     * 更新用戶檔案資料
     * 
     * 根據當前登入用戶的ID更新對應的個人檔案資料
     * 如果找不到資料則返回404錯誤
     * 
     * @param UserProfileUpdateRequest $request 包含已驗證的更新資料的請求對象
     * @return JsonResponse 返回JSON格式的更新後用戶資料或錯誤信息
     */
    public function updateUserProfile(UserProfileUpdateRequest $request): JsonResponse
    {
        try {
            // 查找當前用戶的檔案資料
            $userProfile = UserProfile::where('user_id', $request->user()->id)->first();
            
            // 如果找不到用戶資料，返回404錯誤
            if (!$userProfile) {
                return UserProfileResponse::notFound();
            }

            // 檢查主要電子郵件是否符合
            if ($request->user()->email !== $request->input('user_email')) {
                return UserProfileResponse::emailMismatch();
            }

            // 更新用戶資料
            $userProfile->update($request->validated());
            
            // 返回更新後的用戶資料
            return UserProfileResponse::success($userProfile);
        } catch (\Exception $e) {
            return UserProfileResponse::error();
        }
    }
}