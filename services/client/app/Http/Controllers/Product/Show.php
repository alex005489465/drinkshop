<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Product\Price;
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
        $price = Price::where('product_id', $product->product_id)->first();
        $description = Description::where('product_id', $product->product_id)->first();

        // 假設這些是成分的資料
        $elements = [
            '珍珠奶茶' => '紅茶, 牛奶, 珍珠',
            '綠茶' => '綠茶',
            '紅茶' => '紅茶',
            '四季春茶' => '四季春茶',
            '烏龍茶' => '烏龍茶',
            '茉莉花茶' => '茉莉花, 綠茶',
            '冬瓜茶' => '冬瓜, 茶',
            '檸檬紅茶' => '紅茶, 檸檬',
            '蜂蜜綠茶' => '綠茶, 蜂蜜',
            '芒果綠茶' => '綠茶, 芒果',
            '抹茶拿鐵' => '抹茶, 牛奶',
            '巧克力奶茶' => '紅茶, 牛奶, 巧克力',
            // 其他飲料的成分
        ];

        return response()->json([
            'id' => $product->product_id,
            'name' => $product->product_name,
            'description' => $description->description ?? 'No description available',
            'image_url' => $description->url ?? '', // 新增圖片 URL
            'calories' => $description->calories ?? 'N/A', // 新增熱量
            'elements' => json_encode(explode(', ', $elements[$product->product_name] ?? '茶, 水, 糖')), // 根據飲料名稱生成成分並轉換為 JSON 格式
        ]);
    }
}
