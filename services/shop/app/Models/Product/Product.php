<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product_lists';

    protected $fillable = [
        'product_id',
        'product_name',
        'status',
    ];
}
