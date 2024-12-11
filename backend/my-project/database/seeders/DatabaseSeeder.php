<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users and products first
        User::factory()->count(10)->create();
        Product::factory()->count(20)->create();

        // Then create orders
        Order::factory()->count(5)->create();
    }
}
