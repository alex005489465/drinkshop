<?php

namespace App\Shop\Responses\Order;

use App\Models\Order\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrderListResponse extends JsonResponse
{
    public function __construct()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                return [
                    'order_number' => $order->order_number,
                    'total_amount' => $order->total_amount,
                    'status' => $order->status,
                    'created_at' => $order->created_at->toDateString()
                ];
            });

        parent::__construct([
            'message' => '成功獲取訂單列表',
            'data' => $orders
        ]);
    }
}