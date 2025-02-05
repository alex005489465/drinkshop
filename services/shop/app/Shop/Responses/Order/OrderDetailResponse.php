<?php

namespace App\Shop\Responses\Order;

use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrderDetailResponse extends JsonResponse
{
    public function __construct(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with('items')
            ->first();

        if (!$order || $order->user_id !== Auth::id()) {
            parent::__construct([
                'message' => '訂單資料錯誤',
                'data' => null
            ], 404);
            return;
        }

        $data = [
            'order_number' => $order->order_number,
            'items' => $order->items->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'size' => $item->size,
                    'unit_price' => $item->unit_price,
                    'quantity' => $item->quantity,
                    'total_price' => $item->total_price,
                    'ingredients' => collect($item->ingredients)->pluck('name')->toArray(),
                    'notes' => $item->notes
                ];
            }),
            'total_amount' => $order->total_amount
        ];

        parent::__construct([
            'message' => '成功獲取訂單詳細資料',
            'data' => $data
        ]);
    }
}