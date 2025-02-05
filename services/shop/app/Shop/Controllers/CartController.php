<?php

namespace App\Shop\Controllers;

use App\Shop\Controllers\Controller;
use App\Models\Order\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop\Responses\Cart\ProductListResponse;
use App\Shop\Responses\Cart\OrderItemInitResponse;
use App\Shop\Responses\Cart\CartItemResponse;

class CartController extends Controller
{
    
    public function index(): JsonResponse
    {
        return new ProductListResponse();
    }

    public function listitems(): JsonResponse
    {
        return new OrderItemInitResponse();
    }

    /**
     * 獲取用戶購物車
     */
    public function show(): JsonResponse
    {
        return new CartItemResponse();
    }

    /**
     * 新增/更新購物車
     */
    public function store(Request $request): JsonResponse
    {
        Cart::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'cart_items' => $request->cart_items,
                'total_amount' => $request->total_amount
            ]
        );

        return response()->json([
            'message' => '成功更新購物車',
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