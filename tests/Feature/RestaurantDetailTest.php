<?php

namespace Tests\Feature;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Restaurant;
use Database\Seeders\RestaurantDemoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RestaurantDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_restaurant_detail_shows_information_and_menu_link_without_menu_items(): void
    {
        $restaurant = Restaurant::factory()->create([
            'name' => 'Demo Bistro',
            'description' => 'Neighborhood comfort food.',
            'location' => '123 Main Street',
            'image_url' => 'https://example.test/images/bistro.jpg',
        ]);
        MenuItem::factory()->for($restaurant)->create([
            'name' => 'Bistro Burger',
            'description' => 'Burger with cheddar and house sauce.',
            'price' => 14.50,
            'image_url' => 'https://example.test/images/burger.jpg',
        ]);

        $response = $this->get(route('restaurants.show', $restaurant));

        $response->assertOk()
            ->assertSeeText('Demo Bistro')
            ->assertSeeText('Neighborhood comfort food.')
            ->assertSeeText('123 Main Street')
            ->assertSee('https://example.test/images/bistro.jpg')
            ->assertSeeText('No sales data is available yet.')
            ->assertDontSeeText('Bistro Burger')
            ->assertDontSeeText('Burger with cheddar and house sauce.')
            ->assertDontSeeText('$14.50')
            ->assertDontSee('https://example.test/images/burger.jpg')
            ->assertDontSeeText('Menu details are not displayed on this page.')
            ->assertSee(route('restaurants.index'))
            ->assertSee('#menu');
    }

    public function test_restaurant_fallback_image_is_shown_when_no_url_is_set(): void
    {
        $restaurant = Restaurant::factory()->create(['image_url' => null]);

        $this->get(route('restaurants.show', $restaurant))
            ->assertOk()
            ->assertSee('images/food-placeholder.svg');
    }

    public function test_demo_seeder_uses_restaurant_images_for_menu_items(): void
    {
        $this->seed(RestaurantDemoSeeder::class);

        foreach (['Bistro', 'Taco House'] as $restaurantName) {
            $restaurant = Restaurant::query()
                ->where('name', $restaurantName)
                ->firstOrFail();

            $this->assertSame(
                [$restaurant->image_url],
                $restaurant->menuItems()
                    ->pluck('image_url')
                    ->unique()
                    ->all(),
            );
        }
    }

    public function test_best_sellers_are_ranked_by_units_and_belong_to_the_selected_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();
        $otherRestaurant = Restaurant::factory()->create();

        $topSeller = MenuItem::factory()->for($restaurant)->create(['name' => 'Top Seller']);
        $secondSeller = MenuItem::factory()->for($restaurant)->create(['name' => 'Second Seller']);
        $otherItem = MenuItem::factory()->for($otherRestaurant)->create(['name' => 'Other Restaurant Item']);

        $order = Order::factory()->for($restaurant)->create();
        $order->menuItems()->attach($topSeller, ['quantity' => 5]);
        $order->menuItems()->attach($secondSeller, ['quantity' => 2]);
        $order->menuItems()->attach($otherItem, ['quantity' => 100]);

        $response = $this->get(route('restaurants.show', $restaurant));

        $response->assertOk()
            ->assertSeeTextInOrder(['Top Seller', '5 sold', 'Second Seller', '2 sold'])
            ->assertDontSeeText('Other Restaurant Item');
    }

    public function test_restaurant_detail_shows_empty_state_when_there_are_no_sales(): void
    {
        $restaurant = Restaurant::factory()->create();
        MenuItem::factory()->for($restaurant)->create(['name' => 'Unsold Item']);

        $this->get(route('restaurants.show', $restaurant))
            ->assertOk()
            ->assertSeeText('No sales data is available yet.')
            ->assertDontSeeText('Unsold Item');
    }

    public function test_unknown_restaurant_returns_not_found(): void
    {
        $this->get('/restaurants/999999')->assertNotFound();
    }
}
