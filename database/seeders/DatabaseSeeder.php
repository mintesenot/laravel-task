<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Category::factory(5)->create();
        \App\Models\Brand::factory(5)->create();
        \App\Models\Discount::factory(3)->create();
        \App\Models\Product::factory(20)->create();
        \App\Models\OrderItem::factory(3)->create();
        \App\Models\Order::factory(10)->create();
    }
}
