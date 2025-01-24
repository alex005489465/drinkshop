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
            $table->id();
            $table->ulid('product_id')->unique()->index(); // 使用 ulid 作為 product_id 並設為索引
            $table->string('product_name')->unique(); // 產品名
            $table->boolean('status')->default(true)->index(); // 狀態（上架、下架），使用布爾型態，預設為 true（上架）
            $table->timestamps();
        });

        Schema::create('product_descriptions', function (Blueprint $table) {
            $table->id(); // 自動生成的ID
            $table->char('product_id', 26)->unique()->index(); // 產品ID
            $table->string('url')->nullable(); // URL
            $table->string('description')->nullable(); // 描述
            $table->text('calories')->nullable(); // 熱量
            $table->text('elements')->nullable(); // 成分
            $table->text('allowed_ingredients')->nullable(); // 允許配料，orm模擬json欄位
            $table->timestamps();
        });

        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->char('product_id', 26)->unique()->index(); // 產品ID
            $table->integer('small')->nullable(); // 小杯價錢
            $table->integer('medium')->nullable(); // 中杯價錢
            $table->integer('large')->nullable(); // 大杯價錢
            $table->integer('X_Large')->nullable(); // XL杯價錢
            $table->timestamps();
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();            // 類別ID，應該少於20種
            $table->string('category_name')->unique(); // 類別名
            $table->string('description'); // 描述
            $table->boolean('status')->default(true)->index(); // 狀態（上架、下架），使用布爾型態，預設為 true（上架）
            $table->string('product'); // 包含產品資訊的JSON欄位
            $table->timestamps();
        });

        Schema::create('ingredients', function (Blueprint $table) {  //點飲料時，可以選擇的配料
            $table->id();              // 配料ID，應該少於30種
            $table->string('ingredient_name')->unique()->index(); // 配料名
            $table->integer('price');
            $table->boolean('is_active')->default(true); // 新增狀態欄位，預設值為 true（啟用）
            $table->timestamps();
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
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('ingredients');
    }
};
