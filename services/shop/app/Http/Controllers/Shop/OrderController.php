<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        $products = [
            [
                'id' => 1,
                'name' => '珍珠奶茶',
                'price' => 60,
                'image' => null,
                'category' => ['id' => 1, 'name' => '奶茶']
            ],
            [
                'id' => 2,
                'name' => '茉香奶茶',
                'price' => 55,
                'image' => null,
                'category' => ['id' => 1, 'name' => '奶茶']
            ],
            [
                'id' => 3,
                'name' => '芒果綠茶',
                'price' => 65,
                'image' => null,
                'category' => ['id' => 2, 'name' => '水果茶']
            ],
            [
                'id' => 4,
                'name' => '檸檬紅茶',
                'price' => 50,
                'image' => null,
                'category' => ['id' => 2, 'name' => '水果茶']
            ]
        ];

        return response()->json([
            'data' => $products
        ], 200);
    }
}