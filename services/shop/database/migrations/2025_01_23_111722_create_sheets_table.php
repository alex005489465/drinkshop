<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'shop';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('product_sheets', function (Blueprint $table) {
            $table->id('product_id'); // 產品ID
            $table->string('product_name'); // 產品名
            $table->enum('status', ['available', 'unavailable'])->index(); // 狀態（上架、下架）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sheets');
    }
};
