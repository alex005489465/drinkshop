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
        Schema::create('carts', function (Blueprint $table) {
            // 基本識別欄位
            $table->id();                                     // 購物車ID
            $table->unsignedBigInteger('user_id');           // 用戶ID
            
            // 購物車內容
            $table->json('cart_items')->nullable();          // 購物車項目(JSON格式)
            $table->decimal('total_amount', 10, 2);          // 總金額
            
            // 時間戳記
            $table->timestamps();                            // 創建和更新時間
            $table->softDeletes();                          // 軟刪除
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
