<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory;

    protected $connection = 'shop';
    protected $table = 'prices';

    protected $fillable = [
        'product_id',
        'price_small',
        'price_medium',
        'price_large',
        'price_xl',
    ];

    
}
