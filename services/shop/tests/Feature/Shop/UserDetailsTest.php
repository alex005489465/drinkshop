<?php

use App\Models\User;
use App\Models\ShopUser\UserProfile;
use App\Models\ShopUser\MemberDetail;

// 測試獲取用戶資料
test('user can get profile', function () {
    // 通過註冊API創建用戶
    $this->post('/shops/auth/register', [
        'name' => 'Test User',
        'email' => self::TEST_USER_EMAIL,
        'password' => 'password',
        'password_confirmation' => 'password'
    ]);

    // 登入用戶
    $user = User::where('email', self::TEST_USER_EMAIL)->first();
    $this->actingAs($user);

    $response = $this->get('/shops/user/profile');
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'data' => [
                // 基本識別資料
                'user_name',             // 用戶名稱
                'gender',               // 性別
                'birthdate',            // 生日
                'nationality',          // 國籍
                'id_number',            // 身分證字號
                'notes',                // 備註欄位
                
                // 聯絡資訊
                'user_email',           // 主要電子郵件
                'backup_email',         // 備用電子郵件
                'phone',                // 聯絡電話
                'residential_address',  // 戶籍地址
                'mailing_address'       // 通訊地址
            ]
        ]);
});

// 測試獲取會員資料
test('user can get member details', function () {
    // 通過註冊API創建用戶
    $this->post('/shops/auth/register', [
        'name' => 'Test User',
        'email' => self::TEST_USER_EMAIL,
        'password' => 'password',
        'password_confirmation' => 'password'
    ]);

    // 登入用戶
    $user = User::where('email', self::TEST_USER_EMAIL)->first();
    $this->actingAs($user);

    $response = $this->get('/shops/user/member');
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'data' => [
                'points_balance',       // 會員點數餘額
                'membership_level',     // 會員等級
                'points_expire_at',     // 點數到期時間
                'last_activity_at'      // 最後活動時間
            ]
        ]);
});

// 測試更新用戶資料
test('user can update profile', function () {
    // 通過註冊API創建用戶
    $this->post('/shops/auth/register', [
        'name' => 'Test User',
        'email' => self::TEST_USER_EMAIL,
        'password' => 'password',
        'password_confirmation' => 'password'
    ]);

    // 登入用戶
    $user = User::where('email', self::TEST_USER_EMAIL)->first();
    $this->actingAs($user);

    $updateData = [
        'user_name' => 'Updated Name',              // 更新後的用戶名稱
        'user_email' => self::TEST_USER_EMAIL,      // 主要電子郵件
        'phone' => '0912345678',                    // 聯絡電話
        'residential_address' => '台北市信義區',     // 戶籍地址
        'mailing_address' => '台北市信義區'          // 通訊地址
    ];

    $response = $this->post('/shops/user/profile', $updateData);
    $response->assertStatus(200)
        ->assertJson([
            'message' => '成功獲取用戶資料',
            'data' => $updateData
        ]);
});