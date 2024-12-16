<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all(), 200);
    }

    public function show(Order $order)
    {
        return response()->json($order, 200);
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());
        return response()->json($order, 201);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return response()->json($order, 200);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Order deleted'], 204);
    }

    public function getOrderIdsByUserId($userId)
    {
        $orderIds = Order::where('user_id', $userId)->pluck('id');

        if ($orderIds->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user.'], 404);
        }

        return response()->json($orderIds, 200);
    }
}
