<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantDemoCleanupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::query()
            ->whereIn('name', RestaurantDemoSeeder::RESTAURANT_NAMES)
            ->get()
            ->each
            ->delete();
    }
}
