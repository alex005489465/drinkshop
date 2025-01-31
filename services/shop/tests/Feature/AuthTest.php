<?php

use App\Models\User;

beforeEach(function () {
    // 每次測試前檢查並刪除測試用戶
    User::where('email', 'test@example.com')->delete();
});

afterEach(function () {
    // 每次測試後檢查並刪除測試用戶
    User::where('email', 'test@example.com')->delete();
});

// 測試用戶註冊功能
test('user can register', function () {
    $response = $this->post('/shops/auth/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password'
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'message' => '註冊成功，歡迎 Test User 來到 Bliss Paradise',
            'user' => [
                'name' => 'Test User',
                'email' => 'test@example.com'
            ]
        ]);
});

// 測試用戶登入功能
test('user can login', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password')
    ]);

    $response = $this->post('/shops/auth/login', [
        'email' => 'test@example.com',
        'password' => 'password'
    ]);

    $response->assertOk()
        ->assertJson([
            'message' => "登入成功，歡迎 {$user->name} 來到 Bliss Paradise",
            'user' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ]);
});

// 測試已登入用戶登出功能
test('authenticated user can logout', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password')
    ]);
    
    $this->actingAs($user)
        ->post('/shops/auth/logout')
        ->assertOk()
        ->assertJson([
            'message' => "已登出，期待 {$user->name} 再次光臨"
        ]);
});