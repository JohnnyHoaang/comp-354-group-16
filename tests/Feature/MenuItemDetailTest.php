<?php

namespace Tests\Feature;

use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuItemDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu_item_page_shows_item_details(): void
    {
        $restaurant = Restaurant::factory()->create(['name' => 'Demo Bistro']);
        $menuItem = MenuItem::factory()->for($restaurant)->create([
            'name' => 'Bistro Burger',
            'description' => 'Burger with cheddar and house sauce.',
            'price' => 14.50,
            'image_url' => 'https://example.test/images/burger.jpg',
        ]);

        $this->get(route('restaurants.menu-items.show', [$restaurant, $menuItem]))
            ->assertOk()
            ->assertSeeText('Bistro Burger')
            ->assertSeeText('Burger with cheddar and house sauce.')
            ->assertSeeText('$14.50')
            ->assertSeeText('Demo Bistro')
            ->assertSee('https://example.test/images/burger.jpg')
            ->assertSee(route('restaurants.show', $restaurant));
    }

    public function test_menu_item_fallback_image_is_shown_when_no_url_is_set(): void
    {
        $restaurant = Restaurant::factory()->create();
        $menuItem = MenuItem::factory()->for($restaurant)->create(['image_url' => null]);

        $this->get(route('restaurants.menu-items.show', [$restaurant, $menuItem]))
            ->assertOk()
            ->assertSee('images/food-placeholder.svg');
    }

    public function test_menu_item_from_another_restaurant_returns_not_found(): void
    {
        $restaurant = Restaurant::factory()->create();
        $otherRestaurant = Restaurant::factory()->create();
        $otherItem = MenuItem::factory()->for($otherRestaurant)->create();

        $this->get(route('restaurants.menu-items.show', [$restaurant, $otherItem]))
            ->assertNotFound();
    }

    public function test_unknown_menu_item_returns_not_found(): void
    {
        $restaurant = Restaurant::factory()->create();

        $this->get("/restaurants/{$restaurant->id}/menu/999999")->assertNotFound();
    }
}
