<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    /** @use HasFactory<\Database\Factories\Product\PriceFactory> */
    use HasFactory;

    protected $table = 'product_prices';

    protected $fillable = [
        'product_id',
        'small',
        'medium',
        'large',
        'X_Large',
    ];
}
