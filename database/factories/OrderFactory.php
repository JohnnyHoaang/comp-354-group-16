<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'restaurant_id' => Restaurant::factory(),
            'pickup_time' => fake()->dateTimeBetween('now', '+2 hours'),
            'total_price' => fake()->randomFloat(2, 10, 100),
            'status' => fake()->randomElement(OrderStatus::cases()),
        ];
    }
}
