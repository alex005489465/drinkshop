<?php

namespace App\Shop\Responses\Order;

use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\User;
use App\Models\Product\Ingredient;
use App\Models\Product\Product;
use App\Models\Product\Price;
use Illuminate\Http\JsonResponse;

class OrderCreateResponse extends JsonResponse
{
    /**
     * 建立訂單回應
     * Create order response
     */
    public function __construct(User $user, ?array $cartItems)
    {
        if (empty($cartItems)) {
            parent::__construct([
                'message' => '購物車為空，創建訂單失敗',
                'data' => null
            ], 400);
            return;
        }

        // 建立訂單主檔
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => 0,
            'status' => 'pending'
        ]);

        // 處理訂單項目
        $totalAmount = 0;

        // 取得所有啟用的配料
        $activeIngredients = Ingredient::where('is_active', true)->get();

        foreach ($cartItems as $item) {
            // 檢查產品是否有效
            $product = Product::where('product_id', $item['drinkId'])
                            ->where('status', true)
                            ->first();
            
            if (!$product) {
                continue;
            }

            // 取得基本價格
            $price = Price::where('product_id', $item['drinkId'])->first();
            if (!$price) {
                continue;
            }

            $unitPrice = $price->{$item['size']['type']} ?? 0;

            // 計算配料價格
            $validToppings = [];
            if (isset($item['toppings'])) {
                foreach ($item['toppings'] as $topping) {
                    $ingredient = $activeIngredients->firstWhere('id', $topping['id']);
                    if ($ingredient) {
                        $validToppings[] = [
                            'id' => $ingredient->id,
                            'name' => $ingredient->ingredient_name
                        ];
                        $unitPrice += $ingredient->price;
                    }
                }
            }

            // 計算總價
            $totalPrice = $unitPrice * $item['quantity'];
            
            OrderItem::create([
                'order_number' => $order->order_number,
                'product_id' => $item['drinkId'],
                'size' => $item['size']['type'],
                'unit_price' => $unitPrice,
                'quantity' => $item['quantity'],
                'total_price' => $totalPrice,
                'ingredients' => $validToppings,
                'notes' => $item['note'] ?? null
            ]);

            $totalAmount += $totalPrice;
        }

        // 更新訂單總金額
        $order->update(['total_amount' => $totalAmount]);

        parent::__construct([
            'message' => '訂單建立成功',
            'data' => [
                'order_number' => $order->order_number,
                'total_amount' => $totalAmount
            ]
        ]);
    }
}