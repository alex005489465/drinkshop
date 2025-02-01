<?php

namespace Tests;

use App\Models\User;
use App\Models\ShopUser\MemberDetail;
use App\Models\ShopUser\UserProfile;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * 測試用戶電子郵件
     */
    protected const TEST_USER_EMAIL = 'test@example.com';

    /**
     * 測試準備
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->deleteTestUser();
    }

    /**
     * 測試清理
     */
    protected function tearDown(): void
    {
        $this->deleteTestUser();
        parent::tearDown();
    }

    /**
     * 刪除測試用戶
     */
    protected function deleteTestUser(): void
    {
        $user = User::where('email', self::TEST_USER_EMAIL)->first();
        
        if ($user) {
            // 真正刪除相關資料
            MemberDetail::where('user_id', $user->id)->forceDelete();
            UserProfile::where('user_id', $user->id)->forceDelete();
            $user->delete();
        }
    }
}
