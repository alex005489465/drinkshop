<?php

namespace App\Models\Product;

//use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Description extends Model
{
    use HasFactory;
    
    //protected $connection = 'shop02';
    protected $table = 'descriptions';

    protected $fillable = [
        'product_id',
        'url',
        'description',
        'calories',
        'ingredients',
        'allowed_additives',
    ];


}
