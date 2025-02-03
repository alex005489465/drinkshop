<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product\Product;
use App\Models\Product\Ingredient;
use App\Models\Product\Category;
use App\Models\Product\Price;
use App\Models\Product\Description;
use App\Models\Product\CategoryProduct;
use App\Models\Product\ProductIngredient;

/**
 * 產品資料填充器
 * Product database seeder
 */
class ProductSeeder extends Seeder
{
    /**
     * 執行資料填充
     * Run the database seeds
     */
    public function run(): void
    {
        $this->createDrinkProducts();
        $this->createIngredients();
        $this->createCategories();

        // 延遲五秒，等待數據儲存完成
        sleep(5);

        $this->assignProductsToCategories();
        $this->createPrices();
        $this->createDescriptions();
        $this->assignProductIngredients();  
    }

    /**
     * 創建飲品產品
     * Create drink products
     * 
     * @return void
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
     * 創建配料
     * Create ingredients
     * 
     * @return void
     */
    private function createIngredients(): void
    {
        $ingredients = [
            ['name' => '珍珠', 'price' => 10],
            ['name' => '波霸', 'price' => 10],
            ['name' => '椰果', 'price' => 5],
            ['name' => '芋圓', 'price' => 15],
            ['name' => '仙草', 'price' => 10],
            ['name' => '紅豆', 'price' => 10],
            ['name' => '綠豆', 'price' => 10],
            ['name' => '布丁', 'price' => 15],
            ['name' => '愛玉', 'price' => 15],
            ['name' => '粉條', 'price' => 5],
            ['name' => '小芋圓', 'price' => 10]
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create([
                'ingredient_name' => $ingredient['name'],
                'price' => $ingredient['price'],
                'is_active' => true
            ]);
        }
    }

    /**
     * 創建分類
     * Create categories
     * 
     * @return void
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
            ]);
        }
    }

    /**
     * 將產品分配到分類中
     * Assign products to categories
     * 
     * @return void
     */
    private function assignProductsToCategories(): void
    {
        $categoryProductMap = [
            '奶茶類' => ['珍珠奶茶', '抹茶拿鐵', '巧克力奶茶', '草莓奶茶', '椰香奶茶'],
            '果茶類' => ['藍莓果茶', '百香果綠茶', '葡萄柚綠茶', '蜜桃紅茶', '檸檬紅茶'],
            '純茶類' => ['綠茶', '紅茶', '四季春茶', '烏龍茶', '茉莉花茶'],
            '特調類' => ['冬瓜茶', '蜂蜜綠茶', '芒果綠茶', '玫瑰花茶', '薰衣草茶']
        ];

        // 獲取所有產品和分類
        $products = Product::all();
        $categories = Category::all();

        foreach ($categoryProductMap as $categoryName => $productNames) {
            // 找到對應的分類ID
            $category = $categories->where('category_name', $categoryName)->first();

            foreach ($productNames as $productName) {
                // 找到對應的產品ID
                $product = $products->where('product_name', $productName)->first();

                if ($category && $product) {
                    CategoryProduct::create([
                        'category_id' => $category->id,
                        'product_id' => $product->product_id
                    ]);
                }
            }
        }
    }

    /**
     * 創建價格
     * Create prices
     * 
     * @return void
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
     * 創建產品描述
     * Create product descriptions
     * 
     * @return void
     */
    private function createDescriptions(): void
    {
        $products = Product::all();

        $productsInfo = [
            '珍珠奶茶' => [
                'description' => '香濃奶茶搭配Q彈珍珠，口感豐富。',
                'calories' => '250 kcal',
                'elements' => '紅茶, 牛奶, 珍珠, 糖漿',
            ],
            '抹茶拿鐵' => [
                'description' => '優質抹茶與奶香的完美融合，口感順滑。',
                'calories' => '180 kcal',
                'elements' => '抹茶粉, 牛奶, 糖漿',
            ],
            '巧克力奶茶' => [
                'description' => '濃郁巧克力與奶茶的絕妙搭配，甜而不膩。',
                'calories' => '230 kcal',
                'elements' => '紅茶, 牛奶, 巧克力醬, 糖漿',
            ],
            '草莓奶茶' => [
                'description' => '新鮮草莓的甜美與奶茶的香濃相得益彰。',
                'calories' => '220 kcal',
                'elements' => '紅茶, 牛奶, 草莓醬, 糖漿',
            ],
            '椰香奶茶' => [
                'description' => '椰香四溢，奶茶香濃，讓人彷彿置身於熱帶海島。',
                'calories' => '200 kcal',
                'elements' => '紅茶, 牛奶, 椰子汁, 糖漿',
            ],
            '藍莓果茶' => [
                'description' => '藍莓的酸甜與果茶的清新融合，解渴又美味。',
                'calories' => '150 kcal',
                'elements' => '果茶基底, 藍莓汁, 糖漿',
            ],
            '百香果綠茶' => [
                'description' => '百香果的香氣與綠茶的清新交織，酸甜適口。',
                'calories' => '130 kcal',
                'elements' => '綠茶, 百香果汁, 糖漿',
            ],
            '葡萄柚綠茶' => [
                'description' => '葡萄柚的清新酸甜與綠茶的香氣完美結合。',
                'calories' => '120 kcal',
                'elements' => '綠茶, 葡萄柚汁, 糖漿',
            ],
            '蜜桃紅茶' => [
                'description' => '蜜桃的香甜與紅茶的濃郁相得益彰，口感迷人。',
                'calories' => '140 kcal',
                'elements' => '紅茶, 蜜桃汁, 糖漿',
            ],
            '檸檬紅茶' => [
                'description' => '酸甜的檸檬搭配濃郁紅茶，清爽提神。',
                'calories' => '110 kcal',
                'elements' => '紅茶, 檸檬汁, 糖漿',
            ],
            '綠茶' => [
                'description' => '清爽解渴的純正綠茶，最純粹的味道。',
                'calories' => '0 kcal',
                'elements' => '綠茶葉, 水',
            ],
            '紅茶' => [
                'description' => '濃郁的紅茶香氣，經典回味。',
                'calories' => '0 kcal',
                'elements' => '紅茶葉, 水',
            ],
            '四季春茶' => [
                'description' => '四季皆宜的春茶，清新自然。',
                'calories' => '0 kcal',
                'elements' => '四季春茶葉, 水',
            ],
            '烏龍茶' => [
                'description' => '醇厚的烏龍茶，茶香濃郁，回味悠長。',
                'calories' => '0 kcal',
                'elements' => '烏龍茶葉, 水',
            ],
            '茉莉花茶' => [
                'description' => '茉莉花香四溢，清新怡人。',
                'calories' => '0 kcal',
                'elements' => '茉莉花, 綠茶葉, 水',
            ],
            '冬瓜茶' => [
                'description' => '甜美的冬瓜茶，清涼解渴。',
                'calories' => '90 kcal',
                'elements' => '冬瓜, 水, 糖',
            ],
            '蜂蜜綠茶' => [
                'description' => '蜂蜜的甜美與綠茶的清香完美結合。',
                'calories' => '100 kcal',
                'elements' => '綠茶, 蜂蜜, 水',
            ],
            '芒果綠茶' => [
                'description' => '芒果的香甜與綠茶的清新交織。',
                'calories' => '130 kcal',
                'elements' => '綠茶, 芒果汁, 糖漿',
            ],
            '玫瑰花茶' => [
                'description' => '玫瑰花香四溢，溫潤迷人。',
                'calories' => '0 kcal',
                'elements' => '玫瑰花瓣, 水',
            ],
            '薰衣草茶' => [
                'description' => '薰衣草的芳香與茶的清新融合，舒緩身心。',
                'calories' => '0 kcal',
                'elements' => '薰衣草, 水',
            ],
        ];
        

        foreach ($products as $product) {
            Description::create([
                'product_id' => $product->product_id,
                'url' => null,
                'description' => $productsInfo[$product->product_name]['description'] ?? '美味飲品，值得一試。',
                'calories' => $productsInfo[$product->product_name]['calories'] ?? '未知熱量',
                'elements' => $productsInfo[$product->product_name]['elements'] ?? '茶, 水, 糖',
            ]);
        }
    }

    /**
     * 創建產品與配料的關聯
     * Create product-ingredient relationships
     */
    private function assignProductIngredients(): void
    {
        $productToppings = [
            '珍珠奶茶' => ['珍珠', '波霸', '椰果', '布丁', '紅豆'],
            '抹茶拿鐵' => ['珍珠', '椰果', '芋圓', '紅豆'],
            '巧克力奶茶' => ['珍珠', '波霸', '布丁', '紅豆'],
            '草莓奶茶' => ['珍珠', '椰果', '愛玉', '粉條'],
            '椰香奶茶' => ['珍珠', '椰果', '粉條', '紅豆'],
            '藍莓果茶' => ['椰果', '愛玉', '粉條', '仙草'],
            '百香果綠茶' => ['椰果', '愛玉', '粉條', '仙草'],
            '葡萄柚綠茶' => ['椰果', '愛玉', '粉條'],
            '蜜桃紅茶' => ['椰果', '愛玉', '粉條'],
            '檸檬紅茶' => ['椰果', '愛玉', '粉條'],
            '綠茶' => ['珍珠', '椰果', '愛玉', '紅豆'],
            '紅茶' => ['珍珠', '椰果', '愛玉', '紅豆'],
            '四季春茶' => ['珍珠', '椰果', '愛玉', '紅豆'],
            '烏龍茶' => ['珍珠', '椰果', '愛玉', '紅豆'],
            '茉莉花茶' => ['椰果', '愛玉', '仙草'],
            '冬瓜茶' => ['珍珠', '椰果', '仙草', '愛玉'],
            '蜂蜜綠茶' => ['椰果', '愛玉', '粉條', '仙草'],
            '芒果綠茶' => ['椰果', '愛玉', '粉條'],
            '玫瑰花茶' => ['椰果', '愛玉', '仙草'],
            '薰衣草茶' => ['椰果', '愛玉', '仙草'],
        ];        

        $products = Product::all();
        $ingredients = Ingredient::all();

        foreach ($productToppings as $productName => $ingredientNames) {
            $product = $products->where('product_name', $productName)->first();
            
            if ($product) {
                foreach ($ingredientNames as $ingredientName) {
                    $ingredient = $ingredients->where('ingredient_name', $ingredientName)->first();
                    
                    if ($ingredient) {
                        ProductIngredient::create([
                            'product_id' => $product->product_id,
                            'ingredient_id' => $ingredient->id
                        ]);
                    }
                }
            }
        }
    }
}
