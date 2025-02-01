<?php

namespace App\Models\ShopUser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class UserProfile extends Model
{
    use SoftDeletes;

    /**
     * 指定資料表名稱
     */
    protected $table = 'user_profiles';

    protected $fillable = [
        'user_id',                // 對應 users 表的用戶 ID
        'user_name',              // 用戶名稱
        'nickname',               // 用戶暱稱
        'gender',                 // 性別 (male/female)
        'birthdate',              // 生日
        'nationality',            // 國籍
        'id_number',              // 身分證字號
        'notes',                  // 備註欄位
        'user_email',             // 主要電子郵件
        'backup_email',           // 備用電子郵件
        'phone',                  // 聯絡電話
        'residential_address',    // 戶籍地址
        'mailing_address'         // 通訊地址
    ];

    protected $casts = [
        'birthdate' => 'date:Y-m-d',      // 只保留日期部分，格式為 YYYY-MM-DD
        'member_since' => 'datetime',      // 轉換為日期時間格式
    ];

    // 生日取值器
    public function getBirthdateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }
}