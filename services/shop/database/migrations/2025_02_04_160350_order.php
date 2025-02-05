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
        Schema::create('orders', function (Blueprint $table) {
            /**
             * 訂單ID（自動遞增）
             * Order ID (auto-increment)
             */
            $table->id();

            /**
             * 訂單編號（UUID，26字元）
             * Order number (UUID, 26 characters)
             */
            $table->char('order_number', 26)->unique();

            /**
             * 用戶ID（關聯users表）
             * User ID (references users table)
             */
            $table->unsignedBigInteger('user_id');

            /**
             * 訂單總金額（單位：元）
             * Total order amount (in dollars)
             */
            $table->integer('total_amount')->unsigned();

            /**
             * 訂單狀態
             * Order status:
             * - pending: 待處理 (Pending)
             * - processing: 處理中 (Processing)
             * - completed: 已完成 (Completed)
             * - cancelled: 已取消 (Cancelled)
             */
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])
                  ->default('pending');

            /**
             * 建立及更新時間戳
             * Created and updated timestamps
             */
            $table->timestamps();

            // 索引
            // Indexes
            $table->index('order_number');
            $table->index('status');
        });

        Schema::create('order_items', function (Blueprint $table) {
            /**
             * 訂單項目ID（自動遞增）
             * Order item ID (auto-increment)
             */
            $table->id();

            /**
             * 訂單編號（關聯orders表）
             * Order number (references orders table)
             */
            $table->char('order_number', 26);

            /**
             * 產品ID（關聯product_lists表）
             * Product ID (references product_lists table)
             */
            $table->char('product_id', 26);

            /**
             * 杯型大小
             * Cup size (small/medium/large/X_Large)
             */
            $table->char('size', 7);

            /**
             * 單價
             * Unit price
             */
            $table->integer('unit_price')->unsigned();

            /**
             * 數量
             * Quantity
             */
            $table->integer('quantity')->unsigned();

            /**
             * 總價
             * Total price
             */
            $table->integer('total_price')->unsigned();

            /**
             * 配料資訊（JSON格式）
             * Ingredients information (JSON format)
             */
            $table->json('ingredients')->nullable();

            /**
             * 備註
             * Notes
             */
            $table->text('notes')->nullable();

            /**
             * 建立及更新時間戳
             * Created and updated timestamps
             */
            $table->timestamps();

            // 索引
            // Indexes
            $table->index('order_number');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
    }
};
