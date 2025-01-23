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
        Schema::create('categories', function (Blueprint $collection) {
            $collection->id();
            $collection->string('category'); // 類別
            $collection->text('description'); // 描述
            $collection->json('product'); // 包含產品資訊的JSON欄位
            $collection->timestamps();
        });
        */
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // 類別
            $table->text('description'); // 描述
            $table->text('product'); // 包含產品資訊的JSON欄位
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
