<?php

namespace App\Models\ShopUser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberDetail extends Model
{
    use SoftDeletes;

    /**
     * 指定資料表名稱
     */
    protected $table = 'member_details';

    protected $fillable = [
        'user_id',               // 對應 users 表的 ID
        'points_balance',        // 會員點數餘額
        'membership_level',      // 會員等級
        'points_expire_at',      // 點數到期時間
        'last_activity_at'       // 最後活動時間
    ];

    protected $casts = [
        'points_expire_at' => 'datetime',  // 轉換為日期時間格式
        'last_activity_at' => 'datetime'   // 轉換為日期時間格式
    ];
}