<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $connection = 'shop';
    protected $table = 'ingredients';

    protected $fillable = [
        'ingredient_name',
        'price',
        'is_active', 
    ];
}
