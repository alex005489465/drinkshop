<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 產品分類關聯模型
 * Category-Product Relation Model
 * 
 * @property int $id 關聯ID Relation ID
 * @property string $category_id 分類ID Category ID
 * @property string $product_id 產品ID Product ID
 * @property \Carbon\Carbon $created_at 建立時間 Created at
 * @property \Carbon\Carbon $updated_at 更新時間 Updated at
 */
class CategoryProduct extends Model
{
    /** @use HasFactory<\Database\Factories\Product\CategoryProductFactory> */
    use HasFactory;

    /**
     * 資料表名稱
     * The table associated with the model
     */
    protected $table = 'category_with_product';

    /**
     * 可批量寫入的屬性
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'category_id',
        'product_id'
    ];
}