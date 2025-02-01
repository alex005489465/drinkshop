<?php

namespace App\Listeners\Shop;

use App\Events\Auth\RegisteredUser;
use App\Models\ShopUser\UserProfile;
use App\Models\ShopUser\MemberDetail;

class CreateUserDetailsAfterRegistration
{
    public function handle(RegisteredUser $event): void
    {
        // 創建用戶檔案
        UserProfile::create([
            'user_id' => $event->user->id,
            'user_name' => $event->user->name,
            'user_email' => $event->user->email
        ]);

        // 創建會員明細
        MemberDetail::create([
            'user_id' => $event->user->id,
            'points_balance' => 0,
            'membership_level' => 'normal'
        ]);
    }
}