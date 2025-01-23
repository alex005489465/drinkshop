<?php

use Illuminate\Database\Migrations\Migration;
//use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //protected $connection = 'shop02';
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        Schema::create('descriptions', function (Blueprint $collection) {
            $collection->id(); // 自動生成的ID
            $collection->unsignedBigInteger('product_id'); // 產品ID
            $collection->string('url')->nullable(); // URL
            $collection->text('description')->nullable(); // 描述
            $collection->json('calories')->nullable(); // 熱量
            $collection->json('elements')->nullable(); // 成分
            $collection->json('allowed_ingredients')->nullable(); // 允許配料
            $collection->timestamps();

            $collection->index('product_id');
        });
        */
        Schema::create('descriptions', function (Blueprint $table) {
            $table->id(); // 自動生成的ID
            $table->unsignedBigInteger('product_id'); // 產品ID
            $table->string('url')->nullable(); // URL
            $table->text('description')->nullable(); // 描述
            $table->text('calories')->nullable(); // 熱量
            $table->text('elements')->nullable(); // 成分
            $table->text('allowed_ingredients')->nullable(); // 允許配料
            $table->timestamps();

            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descriptions');
    }
};
