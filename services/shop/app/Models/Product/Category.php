<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 產品分類模型
 * Product Category Model
 * 
 * @property int $id 分類ID Category ID
 * @property string $category_name 分類名稱 Category name
 * @property string $description 分類描述 Category description
 * @property bool $status 分類狀態 Category status
 * @property \Carbon\Carbon $created_at 建立時間 Created at
 * @property \Carbon\Carbon $updated_at 更新時間 Updated at
 */
class Category extends Model
{
    /** @use HasFactory<\Database\Factories\Product\CategoryFactory> */
    use HasFactory;

    /**
     * 資料表名稱
     * The table associated with the model
     */
    protected $table = 'categories';

    /**
     * 可批量寫入的屬性
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'category_name',
        'description',
        'status'
    ];

    /**
     * 型態轉換
     * The attributes that should be cast
     */
    protected $casts = [
        'status' => 'boolean'
    ];
}
