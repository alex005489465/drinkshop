<?php

namespace App\Shop\Responses\Order;

use App\Models\Product\Product;
use App\Models\Product\Price;
use App\Models\Product\Category;
use App\Models\Product\CategoryProduct;
use App\Models\Product\Description;
use Illuminate\Http\JsonResponse;

/**
 * 產品列表回應類別
 * Product List Response Class
 * 
 * @example Response format:
 * [
 *   {
 *     "id": "01JK56DDB9HQPBKR48TCCAVC9N",
 *     "name": "珍珠奶茶",
 *     "price": 60,
 *     "image": null,
 *     "category": {
 *       "id": 1,
 *       "name": "奶茶類"
 *     }
 *   }
 * ]
 */
class ProductListResponse extends JsonResponse
{
    /**
     * 建構子：格式化產品列表資料
     * Constructor: Format product list data
     */
    public function __construct()
    {
        $products = Product::all();  // 獲取所有產品 Get all products

        $formattedProducts = $products->map(function ($product) {
            // 獲取產品價格 Get product price
            $price = Price::where('product_id', $product->product_id)
                         ->value('small');

            // 獲取產品分類 Get product category
            $category = CategoryProduct::where('product_id', $product->product_id)
                ->join('categories', 'category_with_product.category_id', '=', 'categories.id')
                ->select('categories.id', 'categories.category_name')
                ->first();

            $image = Description::where('product_id', $product->product_id)
                               ->value('url');

            return [
                'id' => $product->product_id,
                'name' => $product->product_name,
                'price' => $price ?? 0,
                'image' => $image ?? null,
                'category' => [
                    'id' => $category ? $category->id : 0,
                    'name' => $category ? $category->category_name : ''
                ]
            ];
        });

        parent::__construct([
            'data' => $formattedProducts
        ], 200);
    }
}