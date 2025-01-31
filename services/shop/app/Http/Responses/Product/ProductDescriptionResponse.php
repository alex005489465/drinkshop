<?php

namespace App\Http\Responses\Product;

use App\Models\Product\Product;
use App\Models\Product\Description;
use Illuminate\Http\JsonResponse;

class ProductDescriptionResponse
{
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
                //'allowed_ingredients' => $description ? $description->allowed_ingredients : null
            ];
        });

        return new JsonResponse($formattedProducts);
    }
}