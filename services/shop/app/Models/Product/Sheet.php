<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sheet extends Model
{
    use HasFactory;

    //protected $connection = 'shop';
    protected $table = 'product_sheets';

    
    protected $primaryKey = 'product_id';

    
    protected $fillable = ['product_name', 'status'];

    
    public $timestamps = true;
}
