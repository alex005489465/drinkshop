<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\Product\IngredientFactory> */
    use HasFactory;

    protected $table = 'ingredients';

    protected $fillable = [
        'ingredient_name',
        'price',
        'is_active',
    ];
}
