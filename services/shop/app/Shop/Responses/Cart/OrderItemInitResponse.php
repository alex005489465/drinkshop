<?php

namespace App\Shop\Responses\Cart;

use Illuminate\Http\JsonResponse;
use App\Models\Product\Product;
use App\Models\Product\Price;
use App\Models\Product\Ingredient;
use App\Models\Product\ProductIngredient;

class OrderItemInitResponse extends JsonResponse
{
    public function __construct()
    {
        // Get active ingredients first
        $activeIngredients = Ingredient::where('is_active', true)->get();

        // Get products with relationships
        $products = Product::where('status', true)
            ->get();

        
        // Format response data
        $data = $products->map(function ($product) use ($activeIngredients) {
            // Get prices for this product
            $prices = Price::where('product_id', $product->product_id)
                ->select('small', 'medium', 'large', 'X_Large')
                ->first();

            // Map sizes and prices
            $sizes = [
                'small' => $prices->small,
                'medium' => $prices->medium,
                'large' => $prices->large,
                'X_Large' => $prices->X_Large,
            ];

            // Get toppings for this product
            $toppings = ProductIngredient::where('product_id', $product->product_id)
                ->get()
                ->map(function ($prodIngredient) use ($activeIngredients) {
                    $ingredient = $activeIngredients->firstWhere('id', $prodIngredient->ingredient_id);
                    if ($ingredient) {
                        return [
                            'id' => $ingredient->id,
                            'name' => $ingredient->ingredient_name,
                            'price' => $ingredient->price
                        ];
                    }
                })
                ->filter()
                ->values();

            // Return formatted product data
            return [
                'id' => $product->product_id,
                'name' => $product->product_name,
                'sizes' => $sizes,
                'sugar' => 5,
                'ice' => 5,
                'toppings' => $toppings
            ];
        })->all();
        

        parent::__construct([
            'message' => '成功獲取菜單資料',
            'data' => $data
        ]);
    }
}