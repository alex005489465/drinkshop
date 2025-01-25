<?php

namespace Database\Factories\Product;

use App\Models\Product\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_name' => $this->faker->unique()->word(), // 隨機生成唯一的類別名
            'description' => $this->faker->sentence(), // 隨機生成描述
            'status' => $this->faker->boolean(), // 隨機生成布爾值作為狀態
            'product' => json_encode($this->faker->words(3)), // 隨機生成產品資訊，模擬 JSON 欄位
        ];
    }
}
