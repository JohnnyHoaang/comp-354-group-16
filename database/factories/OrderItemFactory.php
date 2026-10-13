<?php

namespace Database\Factories;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $restaurant = Restaurant::factory()->create();

        return [
            'order_id' => Order::factory()->for($restaurant),
            'menu_item_id' => MenuItem::factory()->for($restaurant),
            'quantity' => fake()->numberBetween(1, 5),
        ];
    }
}
