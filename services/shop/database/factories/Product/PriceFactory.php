<?php

namespace Database\Factories\Product;

use App\Models\Product\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\Price>
 */
class PriceFactory extends Factory
{
    protected $model = Price::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => \Illuminate\Support\Str::ulid(), // 生成 ULID 作為產品 ID
            'small' => $this->faker->numberBetween(30, 50), // 隨機生成小杯價錢
            'medium' => $this->faker->numberBetween(50, 70), // 隨機生成中杯價錢
            'large' => $this->faker->numberBetween(70, 90), // 隨機生成大杯價錢
            'X_Large' => $this->faker->numberBetween(90, 110), // 隨機生成XL杯價錢
        ];
    }
}
