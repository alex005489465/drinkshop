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
            $table->id();
            $table->unsignedBigInteger('user_id'); // Using unsigned big integer to store user ID
            $table->dateTime('order_date');
            $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'cancelled']);
            $table->decimal('total_amount', 8, 2);
            $table->timestamps();
            
            // Manual maintenance method, add index to improve query efficiency
            $table->index('user_id');
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->timestamps();
            
            $table->index('order_id');
            $table->index('product_id');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->dateTime('payment_date');
            $table->decimal('amount', 8, 2);
            $table->string('payment_method');
            $table->timestamps();
            
            $table->index('order_id');
        });

        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); 
            $table->dateTime('shipment_date');
            $table->string('tracking_number')->nullable();
            $table->string('carrier')->nullable();
            $table->timestamps();
            
            $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('shipments');
    }
};
