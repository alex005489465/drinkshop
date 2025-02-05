<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_lists', function (Blueprint $table) {
            // 產品基本資訊表：儲存產品的基本資訊
            // Product lists table: Stores basic product information
            $table->id();                     // 主鍵ID Primary key ID
            $table->char('product_id', 26)    // 產品ID Product ID
                  ->unique()
                  ->index();
            $table->string('product_name')    // 產品名稱 Product name
                  ->unique();
            $table->boolean('status')         // 產品狀態 Product status
                  ->default(true)             // 預設上架 Default active
                  ->index();
            $table->timestamps();             // 建立/更新時間 Created/Updated timestamps
        });        

        Schema::create('product_descriptions', function (Blueprint $table) {
            // 產品詳細資訊表：儲存產品的詳細描述
            // Product descriptions table: Stores detailed product information
            $table->id();                     // 描述ID Description ID
            $table->char('product_id', 26)    // 產品ID Product ID
                  ->unique()
                  ->index();
            $table->string('url')             // 產品圖片URL Product image URL
                  ->nullable();
            $table->string('description')     // 產品描述 Product description
                  ->nullable();
            $table->text('calories')          // 產品熱量 Product calories
                  ->nullable();
            $table->text('elements')          // 產品成分 Product ingredients
                  ->nullable();
            $table->timestamps();             // 建立/更新時間 Created/Updated timestamps
        });

        Schema::create('product_prices', function (Blueprint $table) {
            // 產品價格表：儲存不同size的飲料價格
            // Product prices table: Stores prices for different drink sizes
            $table->id();                     // 價格ID Price ID
            $table->char('product_id', 26)    // 產品ID Product ID
                  ->unique()
                  ->index(); 
            $table->integer('small')          // 小杯價格 Small size price
                  ->nullable();
            $table->integer('medium')         // 中杯價格 Medium size price
                  ->nullable();
            $table->integer('large')          // 大杯價格 Large size price
                  ->nullable();
            $table->integer('X_Large')        // 特大杯價格 Extra large size price
                  ->nullable();
            $table->timestamps();             // 建立/更新時間 Created/Updated timestamps
        });

        Schema::create('categories', function (Blueprint $table) {
            // 產品分類表：儲存產品分類資訊
            // Product categories table: Stores product category information
            $table->id();                     // 分類ID Category ID
            $table->string('category_name')   // 分類名稱 Category name
                  ->unique();
            $table->string('description');    // 分類描述 Category description
            $table->boolean('status')         // 分類狀態 Category status
                  ->default(true)
                  ->index();                  // 預設啟用 Default active
            $table->timestamps();             // 建立/更新時間 Created/Updated timestamps
        });

        Schema::create('ingredients', function (Blueprint $table) {  
            // 配料表：儲存飲料可選配料的資訊
            // Ingredients table: Stores information about available drink add-ons
            $table->id();                     // 配料ID Ingredient ID
            $table->string('ingredient_name') // 配料名稱 Ingredient name
                  ->unique()
                  ->index(); 
            $table->integer('price');         // 配料價格 Ingredient price
            $table->boolean('is_active')      // 配料狀態 Ingredient status
                  ->default(true);            // 預設啟用 Default active
            $table->timestamps();             // 建立/更新時間 Created/Updated timestamps
        });

        Schema::create('category_with_product', function (Blueprint $table) {
            // 產品分類關聯表：紀錄產品與分類的一對一關係
            // Category-Product relation table: Records many-to-many relationships
            $table->id();                     // 關聯ID Relation ID
            $table->string('category_id');    // 分類ID Category ID
            $table->char('product_id', 26)    // 產品ID Product ID
                  ->unique();
            $table->timestamps();             // 建立/更新時間 Created/Updated timestamps
        });

        Schema::create('product_ingredient', function (Blueprint $table) {
            // 產品配料關聯表：紀錄產品與配料的一對多關係
            // Product-Ingredient relation table: Records one-to-many relationships
            $table->id();                     // 關聯ID Relation ID
            $table->char('product_id', 26)    // 產品ID Product ID
                ->index();    
            $table->unsignedBigInteger('ingredient_id');  // 配料ID Ingredient ID
            $table->timestamps();             // 建立/更新時間 Created/Updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_lists');
        Schema::dropIfExists('product_descriptions');
        Schema::dropIfExists('product_prices');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('ingredients');
        Schema::dropIfExists('category_with_product');
        Schema::dropIfExists('product_ingredient');
    }
};
