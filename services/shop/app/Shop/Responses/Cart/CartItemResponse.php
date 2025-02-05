<?php

namespace App\Shop\Responses\Cart;

use App\Models\Order\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartItemResponse extends JsonResponse
{
    public function __construct()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        parent::__construct([
            'message' => '成功獲取購物車資料',
            'data' => [
                //'user_id' => $cart->user_id ?? Auth::id(),
                'cart_items' => $cart->cart_items ?? null,
                'total_amount' => $cart->total_amount ?? 0,
                //'created_at' => $cart->created_at ?? now(),
                //'updated_at' => $cart->updated_at ?? now()
            ]
        ]);
    }
}