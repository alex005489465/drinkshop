<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        return response()->json(OrderDetail::all(), 200);
    }

    public function store(Request $request)
    {
        $orderDetail = OrderDetail::create($request->all());
        return response()->json($orderDetail, 201);
    }

    public function show($id)
    {
        $orderDetail = OrderDetail::find($id);
        if (is_null($orderDetail)) {
            return response()->json(['message' => 'Order Detail not found'], 404);
        }
        return response()->json($orderDetail, 200);
    }

    public function update(Request $request, $id)
    {
        $orderDetail = OrderDetail::find($id);
        if (is_null($orderDetail)) {
            return response()->json(['message' => 'Order Detail not found'], 404);
        }
        $orderDetail->update($request->all());
        return response()->json($orderDetail, 200);
    }

    public function destroy($id)
    {
        $orderDetail = OrderDetail::find($id);
        if (is_null($orderDetail)) {
            return response()->json(['message' => 'Order Detail not found'], 404);
        }
        $orderDetail->delete();
        return response()->json(['message' => 'Order Detail deleted'], 204);
    }
}
