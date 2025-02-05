<?php

namespace App\Shop\Controllers;

use App\Shop\Controllers\Controller;
use App\Shop\Responses\Product\CategoryListResponse;
use App\Shop\Responses\Product\ProductDescriptionResponse;
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
