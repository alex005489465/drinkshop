<?php

namespace App\Shop\Controllers;

use App\Shop\Controllers\Controller;
use App\Shop\Responses\Order\OrderCreateResponse;
use App\Shop\Responses\Order\OrderListResponse;
use App\Shop\Responses\Order\OrderDetailResponse;
use Illuminate\Http\JsonResponse;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * 建立新訂單
     * Create new order
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $user = Auth::user();
        $cartItems = $request->input('cart_items');

        return new OrderCreateResponse($user, $cartItems);
    }

    /**
     * 獲取用戶訂單列表
     * Get user's order list
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new OrderListResponse();
    }

    /**
     * 獲取訂單詳細資料
     * Get order details
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $orderNumber = $request->input('order_number');
        return new OrderDetailResponse($orderNumber);
    }
}