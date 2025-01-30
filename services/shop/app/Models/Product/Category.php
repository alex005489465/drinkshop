<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\Product\CategoryFactory> */
    use HasFactory;

    protected $table = 'product_categories';

    protected $fillable = [
        'category_name',
        'description',
        'status',
        'product',
    ];

    
    protected $casts = [
        'product' => 'json', // 將 product 欄位轉換為 JSON 格式
    ];
    
}
