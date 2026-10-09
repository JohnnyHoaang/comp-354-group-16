<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;

class RestaurantDemoSeeder extends Seeder
{
    public const RESTAURANT_NAMES = [
        'Demo Bistro',
        'Demo Taco House',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bistro = Restaurant::query()->updateOrCreate(
            ['name' => 'Demo Bistro'],
            [
                'description' => 'Casual neighborhood restaurant with simple comfort food.',
                'location' => '123 Main Street',
            ],
        );

        $tacoHouse = Restaurant::query()->updateOrCreate(
            ['name' => 'Demo Taco House'],
            [
                'description' => 'Quick pickup spot for tacos, bowls, and sides.',
                'location' => '48 Market Avenue',
            ],
        );

        $bistroBurger = $this->menuItem($bistro, 'Bistro Burger', 'Beef patty, cheddar, lettuce, and house sauce.', 14.50);
        $tomatoSoup = $this->menuItem($bistro, 'Tomato Soup', 'Slow-simmered tomato soup with basil.', 7.25);
        $gardenSalad = $this->menuItem($bistro, 'Garden Salad', 'Mixed greens, cucumber, tomato, and vinaigrette.', 9.00);

        $chickenTacos = $this->menuItem($tacoHouse, 'Chicken Tacos', 'Three soft tacos with salsa verde.', 12.00);
        $veggieBowl = $this->menuItem($tacoHouse, 'Veggie Bowl', 'Rice, beans, peppers, corn, and avocado crema.', 11.75);
        $chipsAndSalsa = $this->menuItem($tacoHouse, 'Chips and Salsa', 'House chips with mild tomato salsa.', 4.50);

        $this->order(
            restaurant: $bistro,
            pickupTime: CarbonImmutable::tomorrow()->setTime(12, 30),
            status: OrderStatus::Received,
            items: [
                [$bistroBurger, 2],
                [$tomatoSoup, 1],
            ],
        );

        $this->order(
            restaurant: $bistro,
            pickupTime: CarbonImmutable::tomorrow()->setTime(18, 0),
            status: OrderStatus::Preparing,
            items: [
                [$gardenSalad, 1],
                [$tomatoSoup, 2],
            ],
        );

        $this->order(
            restaurant: $tacoHouse,
            pickupTime: CarbonImmutable::tomorrow()->setTime(13, 15),
            status: OrderStatus::ReadyForPickup,
            items: [
                [$chickenTacos, 1],
                [$veggieBowl, 1],
                [$chipsAndSalsa, 2],
            ],
        );
    }

    private function menuItem(Restaurant $restaurant, string $name, string $description, float $price): MenuItem
    {
        return MenuItem::query()->updateOrCreate(
            [
                'restaurant_id' => $restaurant->id,
                'name' => $name,
            ],
            [
                'description' => $description,
                'price' => $price,
            ],
        );
    }

    /**
     * @param  array<int, array{0: MenuItem, 1: int}>  $items
     */
    private function order(Restaurant $restaurant, CarbonImmutable $pickupTime, OrderStatus $status, array $items): void
    {
        $totalPrice = collect($items)->sum(fn (array $item): float => (float) $item[0]->price * $item[1]);

        $order = Order::query()->updateOrCreate(
            [
                'restaurant_id' => $restaurant->id,
                'pickup_time' => $pickupTime,
            ],
            [
                'total_price' => $totalPrice,
                'status' => $status,
            ],
        );

        $order->menuItems()->sync(
            collect($items)
                ->mapWithKeys(fn (array $item): array => [$item[0]->id => ['quantity' => $item[1]]])
                ->all(),
        );
    }
}
