<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product\Ingredient;

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
            'ingredient_name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'is_active' => $this->faker->boolean,
        ];
    }
}
