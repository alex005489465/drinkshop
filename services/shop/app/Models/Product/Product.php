<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

/**
 * 產品模型
 * Product Model
 * 
 * @property int $id 主鍵ID Primary key ID
 * @property string $product_id 產品ID Product ID
 * @property string $product_name 產品名稱 Product name
 * @property bool $status 產品狀態 Product status
 * @property \Carbon\Carbon $created_at 建立時間 Created at
 * @property \Carbon\Carbon $updated_at 更新時間 Updated at
 */
class Product extends Model
{
    /** @use HasFactory<\Database\Factories\Product\ProductFactory> */
    use HasFactory;

    /**
     * 資料表名稱
     * The table associated with the model
     */
    protected $table = 'product_lists';

    /**
     * 可批量寫入的屬性
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'product_id',
        'product_name',
        'status',
    ];

    /**
     * 型態轉換
     * The attributes that should be cast
     */
    protected $casts = [
        'status' => 'boolean'
    ];
}
