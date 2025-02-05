<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 配料模型
 * Ingredient Model
 * 
 * @property int $id 配料ID Ingredient ID
 * @property string $ingredient_name 配料名稱 Ingredient name
 * @property int $price 配料價格 Ingredient price
 * @property bool $is_active 配料狀態 Ingredient status
 * @property \Carbon\Carbon $created_at 建立時間 Created at
 * @property \Carbon\Carbon $updated_at 更新時間 Updated at
 */
class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\Product\IngredientFactory> */
    use HasFactory;

    /**
     * 資料表名稱
     * The table associated with the model
     */
    protected $table = 'ingredients';

    /**
     * 可批量寫入的屬性
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'ingredient_name',
        'price',
        'is_active',
    ];

    /**
     * 型態轉換
     * The attributes that should be cast
     */
    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'integer'
    ];
}
