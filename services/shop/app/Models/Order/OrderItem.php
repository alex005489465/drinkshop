<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 訂單項目模型
 * Order Item Model
 * 
 * @property int $id 訂單項目ID
 * @property string $order_number 訂單編號
 * @property string $product_id 產品ID
 * @property string $size 杯型大小(small/medium/large/X_Large)
 * @property int $unit_price 單價
 * @property int $quantity 數量
 * @property int $total_price 總價
 * @property array|null $ingredients 配料資訊
 * @property string|null $notes 備註
 * @property \Carbon\Carbon $created_at 創建時間
 * @property \Carbon\Carbon $updated_at 更新時間
 * 
 * @property-read Order $order 所屬訂單
 */
class OrderItem extends Model
{
    /**
     * 關聯的資料表
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'order_items';

    protected $fillable = [
        'order_number',
        'product_id',
        'size',
        'unit_price',
        'quantity',
        'total_price',
        'ingredients',
        'notes'        
    ];

    protected $casts = [
        'unit_price' => 'integer',
        'quantity' => 'integer',
        'total_price' => 'integer',
        'ingredients' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_number', 'order_number');
    }
}