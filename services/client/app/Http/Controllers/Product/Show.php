<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Product\Description;

class Show extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $categories = Category::all();

        return view('products.list', ['categories' => $categories]);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::where('product_id', $id)->firstOrFail();
        $description = Description::where('product_id', $product->product_id)->first();

        return response()->json([
            'id' => $product->product_id,
            'name' => $product->product_name,
            'description' => $description->description ?? 'No description available',
            'image_url' => $description->url ?? '', // 新增圖片 URL
            'calories' => $description->calories ?? 'N/A', // 新增熱量
            'elements' => $description->elements ?? '茶, 水, 糖', // 成分
        ]);
    }

    /**
     * Display a listing of the products for selection.
     */
    public function select()
    {
        $categories = Category::all();

        return view('products.select', ['categories' => $categories]);
    }

    /**
     * Display the specified product for selection.
     */
    public function yy(){
        return view('products.vue');
    }
}
