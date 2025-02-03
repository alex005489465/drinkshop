<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 產品詳細資訊模型
 * Product Description Model
 * 
 * @property int $id 描述ID Description ID
 * @property string $product_id 產品ID Product ID
 * @property string|null $url 產品圖片URL Product image URL
 * @property string|null $description 產品描述 Product description
 * @property string|null $calories 產品熱量 Product calories
 * @property string|null $elements 產品成分 Product ingredients
 * @property \Carbon\Carbon $created_at 建立時間 Created at
 * @property \Carbon\Carbon $updated_at 更新時間 Updated at
 */
class Description extends Model
{
    /** @use HasFactory<\Database\Factories\Product\DescriptionFactory> */
    use HasFactory;

    /**
     * 資料表名稱
     * The table associated with the model
     */
    protected $table = 'product_descriptions';

    /**
     * 可批量寫入的屬性
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'product_id',
        'url',
        'description',
        'calories',
        'elements'
    ];
}
