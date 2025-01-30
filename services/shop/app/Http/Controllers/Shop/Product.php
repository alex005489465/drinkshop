<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Response\Product\CategoryListResponse;
use App\Http\Response\Product\ProductDescriptionResponse;
use Illuminate\Http\Request;

class Product extends Controller
{
    /**
     * Display a listing of the resource with formatted response.
     */
    public function list()
    {
        return CategoryListResponse::format();
    }

    /**
     * Display a listing of product descriptions.
     */
    public function description()
    {
        return ProductDescriptionResponse::format();
    }
}
