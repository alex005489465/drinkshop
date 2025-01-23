<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //protected $connection = 'shop';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // 產品ID
            $table->integer('price_small')->nullable(); // 小杯價錢
            $table->integer('price_medium')->nullable(); // 中杯價錢
            $table->integer('price_large')->nullable(); // 大杯價錢
            $table->integer('price_xl')->nullable(); // XL杯價錢
            $table->timestamps();
            
            $table->index('product_id'); // 為產品ID加索引
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
