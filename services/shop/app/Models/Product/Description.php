<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $table = 'product_descriptions';

    protected $fillable = [
        'product_id',
        'url',
        'description',
        'calories',
        'elements',
        'allowed_ingredients',
    ];

    protected $casts = [
        'allowed_ingredients' => 'json', // 將 allowed_ingredients 欄位轉換為 JSON 格式
    ];
}
