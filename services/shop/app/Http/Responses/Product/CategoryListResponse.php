<?php

namespace App\Http\Responses\Product;

use App\Models\Product\Category;
use Illuminate\Http\JsonResponse;

class CategoryListResponse
{
    public static function format(): JsonResponse
    {
        $categories = Category::where('status', true)->get();

        $formattedCategories = $categories->map(function ($category) {
            return [
                'category_id' => $category->id,
                'name' => $category->category_name,
                'product' => $category->product,
            ];
        });

        return new JsonResponse($formattedCategories);
    }
}