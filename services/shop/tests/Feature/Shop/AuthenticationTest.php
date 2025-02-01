<?php

use App\Models\User;

// 測試用戶登入功能
test('user can login', function () {
    // 建立測試用戶
    $user = User::factory()->create([
        'email' => self::TEST_USER_EMAIL,
        'password' => bcrypt('password')
    ]);

    $response = $this->post('/shops/auth/login', [
        'email' => self::TEST_USER_EMAIL,
        'password' => 'password'
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => "登入成功，歡迎 {$user->name} 來到 Bliss Paradise",
            'user' => [
                'name' => $user->name,
                'email' => self::TEST_USER_EMAIL
            ]
        ]);
});

// 測試用戶登出功能
test('user can logout', function () {
    // 建立並登入測試用戶
    $user = User::factory()->create([
        'email' => self::TEST_USER_EMAIL,
        'password' => bcrypt('password')
    ]);
    $this->actingAs($user);

    $response = $this->post('/shops/auth/logout');

    $response->assertStatus(200)
        ->assertJson([
            'message' => "已登出，期待 {$user->name} 再次光臨"
        ]);
});

// 測試檢查用戶登入狀態
test('can check auth status', function () {
    // 未登入狀態
    $response = $this->post('/shops/auth/check');
    $response->assertStatus(401)
        ->assertJson([
            'message' => '請先登入'
        ]);

    // 已登入狀態
    $user = User::factory()->create([
        'email' => self::TEST_USER_EMAIL,
        'password' => bcrypt('password')
    ]);
    $this->actingAs($user);
    
    $response = $this->post('/shops/auth/check');
    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Welcome to Drinkshop!',
            'user' => [
                'name' => $user->name,
                'email' => self::TEST_USER_EMAIL
            ]
        ]);
});