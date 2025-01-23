<?php

namespace Database\Factories\Product;

use App\Models\Product\Sheet;
use Illuminate\Database\Eloquent\Factories\Factory;

class SheetFactory extends Factory
{
    protected $model = Sheet::class;

    public function definition(): array
    {
        return [
            'product_name' => $this->faker->word,
            'status' => $this->faker->randomElement(['available', 'unavailable']),
        ];
    }
}
