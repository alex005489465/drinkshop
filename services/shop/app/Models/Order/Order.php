<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * 訂單模型
 * Order Model
 * 
 * @property int $id 訂單ID
 * @property string $order_number 訂單編號（UUID，26字元）
 * @property int $user_id 用戶ID
 * @property int $total_amount 訂單總金額
 * @property string $status 訂單狀態 (pending/processing/completed/cancelled)
 * @property \Carbon\Carbon $created_at 創建時間
 * @property \Carbon\Carbon $updated_at 更新時間
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection|OrderItem[] $items 訂單項目
 */
class Order extends Model
{
    /**
     * The "booting" method of the model.
     * 模型啟動時的方法
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = (string) Str::ulid();
        });
    }

    /**
     * 關聯的資料表
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'total_amount',
        'status'
    ];

    protected $casts = [
        'total_amount' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_number', 'order_number');
    }
}