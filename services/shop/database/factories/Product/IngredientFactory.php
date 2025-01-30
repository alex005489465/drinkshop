<?php

namespace Database\Factories\Product;

use App\Models\Product\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\Ingredient>
 */
class IngredientFactory extends Factory
{
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ingredient_name' => $this->faker->unique()->word(), // 隨機生成唯一的配料名
            'price' => $this->faker->numberBetween(5, 50), // 隨機生成價格
            'is_active' => $this->faker->boolean(), // 隨機生成布爾值作為狀態
        ];
    }
}
