<?php

namespace App\Models\Product;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    
    protected $connection = 'shop02';
    protected $table = 'categories';

    protected $fillable = [
        'category',
        'description',
        'product',
    ];
}
