<?php

namespace App\Shop\Responses\Product;

use App\Models\Product\Category;
use App\Models\Product\CategoryProduct;
use Illuminate\Http\JsonResponse;

/**
 * 分類列表回應
 * Category List Response
 * 
 * @example Response format:
 * [
 *   {
 *     "category_id": 1,
 *     "name": "奶茶類",
 *     "product": [
 *       {
 *         "id": "01JK56DDB9HQPBKR48TCCAVC9N",
 *         "name": "珍珠奶茶"
 *       },
 *       {
 *         "id": "01JK56DEGJADS6RF1ES15Z6FE0",
 *         "name": "抹茶拿鐵"
 *       },
 *       {
 *         "id": "01JK56DEM06KW1PY6GK8PJ5V5V",
 *         "name": "巧克力奶茶"
 *       },
 *       {
 *         "id": "01JK56DEQKTCCFFSCJNV82KKGP",
 *         "name": "草莓奶茶"
 *       },
 *       {
 *         "id": "01JK56DEV1H9YDJQHPFWCE4KTK",
 *         "name": "椰香奶茶"
 *       }
 *     ]
 *   }
 * ]
 */
class CategoryListResponse
{
    /**
     * 格式化分類列表資料
     * Format category list data
     * 
     * @return JsonResponse 分類列表資料 Category list data
     */
    public static function format(): JsonResponse
    {
        // 獲取所有啟用的分類
        // Get all active categories
        $categories = Category::where('status', true)->get();

        $formattedCategories = $categories->map(function ($category) {
            // 獲取該分類的所有產品
            // Get all products for this category
            $categoryProducts = CategoryProduct::where('category_id', $category->id)
                ->join('product_lists', 'category_with_product.product_id', '=', 'product_lists.product_id')
                ->get();

            // 格式化產品資料為所需結構
            // Format products into required structure
            $products = [];
            foreach ($categoryProducts as $index => $product) {
                $products[(string)$index] = [
                    'id' => $product->product_id,
                    'name' => $product->product_name
                ];
            }

            return [
                'category_id' => $category->id,
                'name' => $category->category_name,
                'product' => $products
            ];
        });

        return new JsonResponse($formattedCategories);
    }
}