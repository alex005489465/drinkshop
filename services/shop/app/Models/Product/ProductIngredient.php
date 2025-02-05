<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 產品配料關聯模型
 * Product-Ingredient Relation Model
 * 
 * @property int $id 關聯ID Relation ID
 * @property string $product_id 產品ID Product ID
 * @property int $ingredient_id 配料ID Ingredient ID
 * @property \Carbon\Carbon $created_at 建立時間 Created at
 * @property \Carbon\Carbon $updated_at 更新時間 Updated at
 */
class ProductIngredient extends Model
{
    /** @use HasFactory<\Database\Factories\Product\ProductIngredientFactory> */
    use HasFactory;

    /**
     * 資料表名稱
     * The table associated with the model
     */
    protected $table = 'product_ingredient';

    /**
     * 可批量寫入的屬性
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'product_id',
        'ingredient_id'
    ];
}