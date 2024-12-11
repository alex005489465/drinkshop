<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'name', 'description', 'price', 'sku', 'quantity', 'category', 'image_url'
    ];

    // Specify the attributes that should be cast to native types
    protected $casts = [
        'price' => 'float',
        'quantity' => 'integer'
    ];

    // Define constants for product categories
    const CATEGORIES = [
        'milk',
        'tea',
        'other'
    ];

    // Validate the category attribute when setting it
    public function setCategoryAttribute($value)
    {
        if (!in_array($value, self::CATEGORIES)) {
            throw new \InvalidArgumentException('Invalid category');
        }
        $this->attributes['category'] = $value;
    }
}
