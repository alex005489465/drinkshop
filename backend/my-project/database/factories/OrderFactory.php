<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Randomly query users from database
            'order_date' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(['pending', 'paid', 'shipped', 'completed', 'cancelled']),
            'total_amount' => 0, // Will be updated after creating order details
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            $totalAmount = 0;
            
            $orderDetailsCount = $this->faker->numberBetween(1, 5);
            $orderDetails = OrderDetail::factory()->count($orderDetailsCount)->create([
                'order_id' => $order->id,
                'product_id' => Product::inRandomOrder()->first()->id,
                'quantity' => $this->faker->numberBetween(1, 5),
                'price' => function(array $attributes) use (&$totalAmount) {
                    $productPrice = Product::find($attributes['product_id'])->price;
                    $linePrice = $attributes['quantity'] * $productPrice;
                    $totalAmount += $linePrice;
                    return $linePrice;
                }
            ]);

            // Update total amount in the order model after creating order details
            $order->update(['total_amount' => $totalAmount]);

            Payment::factory()->create([
                'order_id' => $order->id,
                'payment_date' => $this->faker->dateTime(),
                'amount' => $totalAmount,
                'payment_method' => $this->faker->randomElement(['credit card', 'paypal', 'bank transfer']),
            ]);

            Shipment::factory()->create([
                'order_id' => $order->id,
                'shipment_date' => $this->faker->dateTimeBetween($order->order_date, 'now'),
                'tracking_number' => $this->faker->uuid,
                'carrier' => $this->faker->randomElement(['UPS', 'FedEx', 'DHL']),
            ]);
        });
    }
}
