<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * 獲取用戶購物車
     */
    public function show(): JsonResponse
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        
        return response()->json([
            'message' => '成功獲取購物車資料',
            'data' => $cart
        ]);
    }

    /**
     * 新增/更新購物車
     */
    public function store(Request $request): JsonResponse
    {
        $cart = Cart::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'cart_items' => $request->cart_items,
                'total_amount' => $request->total_amount
            ]
        );

        return response()->json([
            'message' => '成功更新購物車',
            'data' => $cart
        ], 201);
    }

    /**
     * 清空購物車
     */
    public function destroy(): JsonResponse
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if ($cart) {
            $cart->update([
                'cart_items' => null,
                'total_amount' => 0
            ]);
        }

        return response()->json([
            'message' => '成功清空購物車'
        ]);
    }
}