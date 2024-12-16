<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderCreatorController extends Controller
{
    protected $orderController;
    protected $orderDetailController;
    protected $shipmentController;
    protected $paymentController;

    public function __construct(
        OrderController $orderController, 
        OrderDetailController $orderDetailController, 
        ShipmentController $shipmentController, 
        PaymentController $paymentController
    ) {
        $this->orderController = $orderController;
        $this->orderDetailController = $orderDetailController;
        $this->shipmentController = $shipmentController;
        $this->paymentController = $paymentController;
    }

    public function createOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            // Step 1: Create order
            $orderResponse = $this->orderController->store($request);
            $order = json_decode($orderResponse->getContent(), true);
            $orderId = $order['id'];

            // Step 2: Create order details
            $orderDetails = $request->input('order_details');
            foreach ($orderDetails as $orderDetail) {
                $orderDetail['order_id'] = $orderId;
                $this->orderDetailController->store(new Request($orderDetail));
            }

            // Step 3: Create shipment info
            $shipmentInfo = $request->input('shipment_info');
            $shipmentInfo['order_id'] = $orderId;
            $this->shipmentController->store(new Request($shipmentInfo));

            // Step 4: Calculate total amount and create payment info
            $totalAmount = $request->input('total_amount');
            $paymentInfo = [
                'order_id' => $orderId,
                'amount' => $totalAmount
            ];
            $this->paymentController->store(new Request($paymentInfo));

            DB::commit();

            return response()->json(['order_id' => $orderId], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Order creation failed', 'error' => $e->getMessage()], 500);
        }
    }
}
