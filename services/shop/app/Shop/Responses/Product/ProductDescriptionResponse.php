<?php

namespace App\Shop\Responses\Product;

use App\Models\Product\Product;
use App\Models\Product\Description;
use Illuminate\Http\JsonResponse;

/**
 * 產品描述回應類別
 * Product Description Response Class
 * 
 * @example Response format:
 * [
 *   {
 *     "product_id": "01JK56DDB9HQPBKR48TCCAVC9N",
 *     "name": "珍珠奶茶",
 *     "description": "香濃奶茶搭配Q彈珍珠，口感豐富。",
 *     "calories": "250 kcal",
 *     "elements": "紅茶, 牛奶, 珍珠, 糖漿"
 *   }
 * ]
 */
class ProductDescriptionResponse
{
    /**
     * 格式化產品描述資料
     * Format product description data
     * 
     * @return JsonResponse 產品描述資料 Product description data
     */
    public static function format(): JsonResponse
    {
        $products = Product::where('status', true)
            ->select('product_id', 'product_name')
            ->get();

        $formattedProducts = $products->map(function ($product) {
            $description = Description::where('product_id', $product->product_id)
                ->first();

            return [
                'product_id' => $product->product_id,
                'name' => $product->product_name,
                'description' => $description ? $description->description : null,
                'calories' => $description ? $description->calories : null,
                'elements' => $description ? $description->elements : null,
            ];
        });

        return new JsonResponse($formattedProducts);
    }
}