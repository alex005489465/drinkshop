<?php

use App\Models\User;
use App\Models\ShopUser\UserProfile;
use App\Models\ShopUser\MemberDetail;

// 測試用戶註冊功能
test('user can register', function () {
    $response = $this->post('/shops/auth/register', [
        'name' => 'Test User',
        'email' => self::TEST_USER_EMAIL,
        'password' => 'password',
        'password_confirmation' => 'password'
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'message' => '註冊成功，歡迎 Test User 來到 Bliss Paradise',
            'user' => [
                'name' => 'Test User',
                'email' => self::TEST_USER_EMAIL
            ]
        ]);
});

// 測試註冊時密碼確認不符
test('user cannot register with password mismatch', function () {
    $response = $this->post('/shops/auth/register', [
        'name' => 'Test User',
        'email' => self::TEST_USER_EMAIL,
        'password' => 'password',
        'password_confirmation' => 'different'
    ]);

    $response->assertStatus(302)
        ->assertInvalid(['password'])
        ->assertSessionHasErrors(['password' => '密碼確認不符']);
});

// 測試註冊後創建用戶檔案和會員明細
test('registration creates user profile and member details', function () {
    // 執行註冊
    $response = $this->post('/shops/auth/register', [
        'name' => 'Test User',
        'email' => self::TEST_USER_EMAIL,
        'password' => 'password',
        'password_confirmation' => 'password'
    ]);

    // 獲取用戶ID
    $user = User::where('email', self::TEST_USER_EMAIL)->first();
    
    // 驗證用戶檔案是否創建
    $userProfile = UserProfile::where('user_id', $user->id)->first();
    expect($userProfile)->not->toBeNull()
        ->and($userProfile->user_name)->toBe('Test User')
        ->and($userProfile->user_email)->toBe(self::TEST_USER_EMAIL);

    // 驗證會員明細是否創建
    $memberDetail = MemberDetail::where('user_id', $user->id)->first();
    expect($memberDetail)->not->toBeNull()
        ->and($memberDetail->points_balance)->toBe(0)
        ->and($memberDetail->membership_level)->toBe('normal');
});