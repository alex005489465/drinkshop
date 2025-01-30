<?php

namespace Database\Factories\Product;

use App\Models\Product\Description;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\Description>
 */
class DescriptionFactory extends Factory
{
    protected $model = Description::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Str::ulid(), // 生成 ULID 作為產品 ID
            'url' => $this->faker->url(), // 隨機生成 URL
            'description' => $this->faker->sentence(), // 隨機生成描述
            'calories' => $this->faker->numberBetween(50, 500) . ' kcal', // 隨機生成熱量
            'elements' => $this->faker->words(5, true), // 隨機生成成分
            'allowed_ingredients' => json_encode($this->faker->words(3)), // 隨機生成允許配料，模擬 JSON 欄位
        ];
    }
}
