<?php

namespace Database\Factories\Product;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Str::ulid(), // 生成 ULID
            'product_name' => $this->faker->unique()->word(), // 生成唯一的產品名
            'status' => $this->faker->boolean(), // 隨機生成布爾值作為狀態
        ];
    }
}
