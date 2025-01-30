<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product\Product;
use App\Models\Product\Ingredient;
use App\Models\Product\Category;
use App\Models\Product\Price;
use App\Models\Product\Description;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createDrinkProducts();
        $this->createIngredients();
        $this->createCategories();

        // 延遲二十秒，等待數據儲存完成
        sleep(20);

        $this->assignProductsToCategories();
        $this->createPrices();
        $this->createDescriptions();
    }

    /**
     * Create twenty drink products.
     */
    private function createDrinkProducts(): void
    {
        $drinks = [
            '珍珠奶茶',
            '綠茶',
            '紅茶',
            '四季春茶',
            '烏龍茶',
            '茉莉花茶',
            '冬瓜茶',
            '檸檬紅茶',
            '蜂蜜綠茶',
            '芒果綠茶',
            '抹茶拿鐵',
            '巧克力奶茶',
            '草莓奶茶',
            '椰香奶茶',
            '藍莓果茶',
            '百香果綠茶',
            '葡萄柚綠茶',
            '蜜桃紅茶',
            '玫瑰花茶',
            '薰衣草茶'
        ];

        foreach ($drinks as $drink) {
            Product::create([
                'product_id' => \Illuminate\Support\Str::ulid(),
                'product_name' => $drink,
                'status' => true
            ]);
        }
    }

    /**
     * Create ten ingredients.
     */
    private function createIngredients(): void
    {
        $ingredients = [
            '珍珠',
            '椰果',
            '芋圓',
            '仙草',
            '紅豆',
            '綠豆',
            '布丁',
            '愛玉',
            '粉條',
            '小芋圓'
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create([
                'ingredient_name' => $ingredient,
                'price' => rand(5, 20), // 隨機生成價格
                'is_active' => true
            ]);
        }
    }

    /**
     * Create four drink categories.
     */
    private function createCategories(): void
    {
        $categories = [
            '奶茶類' => '各種奶茶飲品，香濃順口',
            '果茶類' => '新鮮水果茶，清爽解渴',
            '純茶類' => '純正茶葉泡製，回味無窮',
            '特調類' => '獨家特調飲品，風味獨特'
        ];

        foreach ($categories as $category => $description) {
            Category::create([
                'category_name' => $category,
                'description' => $description, // 簡單描述
                'status' => true,
                'product' => json_encode([]) // 初始為空的產品資訊
            ]);
        }
    }

    /**
     * Assign products to categories.
     */
    private function assignProductsToCategories(): void
    {
        $categories = Category::all();
        $products = Product::all();

        $categoryProductMap = [
            '奶茶類' => ['珍珠奶茶', '抹茶拿鐵', '巧克力奶茶', '草莓奶茶', '椰香奶茶'],
            '果茶類' => ['藍莓果茶', '百香果綠茶', '葡萄柚綠茶', '蜜桃紅茶', '檸檬紅茶'],
            '純茶類' => ['綠茶', '紅茶', '四季春茶', '烏龍茶', '茉莉花茶'],
            '特調類' => ['冬瓜茶', '蜂蜜綠茶', '芒果綠茶', '玫瑰花茶', '薰衣草茶']
        ];

        foreach ($categories as $category) {
            $productNames = $categoryProductMap[$category->category_name] ?? [];
            $categoryProducts = $products->whereIn('product_name', $productNames)->map(function ($product) {
                return ['id' => $product->product_id, 'name' => $product->product_name];
            });

            $category->product = $categoryProducts;
            $category->save();
        }
    }

    /**
     * Create prices for products.
     */
    private function createPrices(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            Price::create([
                'product_id' => $product->product_id,
                'small' => rand(30, 50), // 隨機生成小杯價錢
                'medium' => rand(50, 70), // 隨機生成中杯價錢
                'large' => rand(70, 90), // 隨機生成大杯價錢
                'X_Large' => rand(90, 110) // 隨機生成XL杯價錢
            ]);
        }
    }

    /**
     * Create descriptions for products.
     */
    private function createDescriptions(): void
    {
        $products = Product::all();
        $ingredients = Ingredient::all()->map(function ($ingredient) {
            return [
                'id' => $ingredient->id,
                'name' => $ingredient->ingredient_name
            ];
        })->toArray();

        $descriptions = [
            '珍珠奶茶' => '香濃奶茶搭配Q彈珍珠，口感豐富。',
            '綠茶' => '清爽解渴的綠茶，適合夏日飲用。',
            '紅茶' => '濃郁的紅茶香氣，回味無窮。',
            '四季春茶' => '四季皆宜的春茶，清新自然。',
            '烏龍茶' => '醇厚的烏龍茶，茶香濃郁。',
            '茉莉花茶' => '茉莉花香四溢，清新怡人。',
            '冬瓜茶' => '甜美的冬瓜茶，清涼解渴。',
            '檸檬紅茶' => '酸甜檸檬搭配紅茶，口感清爽。',
            '蜂蜜綠茶' => '蜂蜜的甜美與綠茶的清香完美結合。',
            '芒果綠茶' => '芒果的香甜與綠茶的清新交織。',
            '抹茶拿鐵' => '濃郁抹茶與奶香的完美融合。',
            '巧克力奶茶' => '香濃巧克力與奶茶的絕妙搭配。',
            '草莓奶茶' => '草莓的甜美與奶茶的香濃相得益彰。',
            '椰香奶茶' => '椰香四溢，奶茶香濃。',
            '藍莓果茶' => '藍莓的酸甜與果茶的清新融合。',
            '百香果綠茶' => '百香果的香氣與綠茶的清新交織。',
            '葡萄柚綠茶' => '葡萄柚的酸甜與綠茶的清新結合。',
            '蜜桃紅茶' => '蜜桃的香甜與紅茶的濃郁相得益彰。',
            '玫瑰花茶' => '玫瑰花香四溢，清新怡人。',
            '薰衣草茶' => '薰衣草的香氣與茶的清新融合。'
        ];

        $elements = [
            '珍珠奶茶' => '紅茶, 牛奶, 珍珠',
            '綠茶' => '綠茶',
            '紅茶' => '紅茶',
            '四季春茶' => '四季春茶',
            '烏龍茶' => '烏龍茶',
            '茉莉花茶' => '茉莉花, 綠茶',
            '冬瓜茶' => '冬瓜, 茶',
            '檸檬紅茶' => '紅茶, 檸檬',
            '蜂蜜綠茶' => '綠茶, 蜂蜜',
            '芒果綠茶' => '綠茶, 芒果',
            '抹茶拿鐵' => '抹茶, 牛奶',
            '巧克力奶茶' => '紅茶, 牛奶, 巧克力',
            '草莓奶茶' => '紅茶, 牛奶, 草莓',
            '椰香奶茶' => '紅茶, 牛奶, 椰子',
            '藍莓果茶' => '果茶, 藍莓',
            '百香果綠茶' => '綠茶, 百香果',
            '葡萄柚綠茶' => '綠茶, 葡萄柚',
            '蜜桃紅茶' => '紅茶, 蜜桃',
            '玫瑰花茶' => '玫瑰花, 茶',
            '薰衣草茶' => '薰衣草, 茶'
        ];

        foreach ($products as $product) {
            Description::create([
                'product_id' => $product->product_id,
                'url' => \Faker\Factory::create()->url(), // 隨機生成 URL
                'description' => $descriptions[$product->product_name] ?? '美味飲品，值得一試。',
                'calories' => rand(50, 500) . ' kcal', // 隨機生成熱量
                'elements' => $elements[$product->product_name] ?? '茶, 水, 糖', // 根據飲料名稱生成成分
                'allowed_ingredients' => \Faker\Factory::create()->randomElements($ingredients, 3), // 隨機生成允許配料，模擬 JSON 欄位
            ]);
        }
    }
}
