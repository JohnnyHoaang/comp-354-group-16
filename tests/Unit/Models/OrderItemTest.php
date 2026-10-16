<?php

namespace Tests\Unit\Models;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_assigns_order_and_menu_item_to_the_same_restaurant(): void
    {
        $orderItem = OrderItem::factory()->create();

        $this->assertSame(
            $orderItem->order->restaurant_id,
            $orderItem->menuItem->restaurant_id,
        );
    }

    public function test_factory_does_not_reuse_restaurant_across_separate_order_items(): void
    {
        $first = OrderItem::factory()->create();
        $second = OrderItem::factory()->create();

        $this->assertNotSame(
            $first->order->restaurant_id,
            $second->order->restaurant_id,
        );
    }

    public function test_order_item_can_still_be_created_for_an_explicit_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $orderItem = OrderItem::factory()->create([
            'order_id' => Order::factory()->for($restaurant),
            'menu_item_id' => MenuItem::factory()->for($restaurant),
        ]);

        $this->assertSame($restaurant->id, $orderItem->order->restaurant_id);
        $this->assertSame($restaurant->id, $orderItem->menuItem->restaurant_id);
    }
}
