<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 產品價格模型
 * Product Price Model
 * 
 * @property int $id 價格ID Price ID
 * @property string $product_id 產品ID Product ID
 * @property int|null $small 小杯價格 Small size price
 * @property int|null $medium 中杯價格 Medium size price
 * @property int|null $large 大杯價格 Large size price
 * @property int|null $X_Large 特大杯價格 Extra large size price
 * @property \Carbon\Carbon $created_at 建立時間 Created at
 * @property \Carbon\Carbon $updated_at 更新時間 Updated at
 */
class Price extends Model
{
    /** @use HasFactory<\Database\Factories\Product\PriceFactory> */
    use HasFactory;

    /**
     * 資料表名稱
     * The table associated with the model
     */
    protected $table = 'product_prices';

    /**
     * 可批量寫入的屬性
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'product_id',
        'small',
        'medium',
        'large',
        'X_Large',
    ];

    /**
     * 型態轉換
     * The attributes that should be cast
     */
    protected $casts = [
        'small' => 'integer',
        'medium' => 'integer',
        'large' => 'integer',
        'X_Large' => 'integer'
    ];
}
