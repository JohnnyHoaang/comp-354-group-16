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
    private const PLACEHOLDER_IMAGE = 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80';

    public const RESTAURANT_NAMES = [
        'Bistro',
        'Taco House',
        'Pizzeria',
        'Sushi Bar',
        'Curry House',
        'Noodle Bar',
        'BBQ Pit',
        'Thai Kitchen',
        'Mediterranean Grill',
        'Vegan Table',
        'Burger Joint',
        'Seafood Shack',
        'Breakfast Nook',
        'Deli Corner',
        'Bakery and Sweets',
        'Steakhouse',
        'Ramen House',
    ];

    /**
     * Additional demo restaurants and their menus, keyed by restaurant name.
     *
     * @var array<int, array{name: string, description: string, location: string, image_url: string, menu: array<int, array{name: string, description: string, price: float}>}>
     */
    private const ADDITIONAL_RESTAURANTS = [
        [
            'name' => 'Pizzeria',
            'description' => 'Wood-fired pizza shop with classic and specialty pies.',
            'location' => '12 Vine Street',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Margherita Pizza', 'description' => 'Tomato sauce, fresh mozzarella, and basil.', 'price' => 13.00],
                ['name' => 'Pepperoni Pizza', 'description' => 'Tomato sauce, mozzarella, and spicy pepperoni.', 'price' => 14.50],
                ['name' => 'Four Cheese Pizza', 'description' => 'Mozzarella, parmesan, gorgonzola, and fontina.', 'price' => 15.00],
                ['name' => 'Caesar Salad', 'description' => 'Romaine, parmesan, croutons, and Caesar dressing.', 'price' => 8.50],
                ['name' => 'Garlic Knots', 'description' => 'Warm knots brushed with garlic butter and herbs.', 'price' => 5.75],
            ],
        ],
        [
            'name' => 'Sushi Bar',
            'description' => 'Fresh sushi and rolls made to order.',
            'location' => '88 Harbor Lane',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'California Roll', 'description' => 'Crab, avocado, and cucumber.', 'price' => 9.00],
                ['name' => 'Spicy Tuna Roll', 'description' => 'Tuna, spicy mayo, and scallion.', 'price' => 10.50],
                ['name' => 'Salmon Nigiri (2pc)', 'description' => 'Fresh salmon over seasoned rice.', 'price' => 7.00],
                ['name' => 'Miso Soup', 'description' => 'Tofu, seaweed, and scallion in miso broth.', 'price' => 4.00],
                ['name' => 'Edamame', 'description' => 'Steamed soybeans with sea salt.', 'price' => 5.00],
            ],
        ],
        [
            'name' => 'Curry House',
            'description' => 'Comforting Indian curries and tandoor favorites.',
            'location' => '231 Spice Road',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Butter Chicken', 'description' => 'Tandoori chicken in a creamy tomato curry.', 'price' => 15.50],
                ['name' => 'Chana Masala', 'description' => 'Chickpeas simmered in a spiced tomato sauce.', 'price' => 12.00],
                ['name' => 'Garlic Naan', 'description' => 'Tandoor-baked flatbread with garlic and butter.', 'price' => 3.50],
                ['name' => 'Vegetable Samosas (2pc)', 'description' => 'Crispy pastries filled with spiced potatoes and peas.', 'price' => 5.50],
                ['name' => 'Mango Lassi', 'description' => 'Chilled yogurt drink blended with mango.', 'price' => 4.50],
            ],
        ],
        [
            'name' => 'Noodle Bar',
            'description' => 'Hand-pulled noodles and classic Chinese stir-fry.',
            'location' => '57 Canton Court',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Beef Lo Mein', 'description' => 'Stir-fried noodles with beef and vegetables.', 'price' => 13.50],
                ['name' => 'Kung Pao Chicken', 'description' => 'Chicken, peanuts, and chili peppers in a savory sauce.', 'price' => 14.00],
                ['name' => 'Vegetable Dumplings (6pc)', 'description' => 'Steamed dumplings with a soy-vinegar dip.', 'price' => 8.00],
                ['name' => 'Hot and Sour Soup', 'description' => 'Tofu, mushroom, and bamboo shoots in a tangy broth.', 'price' => 5.50],
                ['name' => 'Fried Rice', 'description' => 'Wok-fried rice with egg, peas, and carrot.', 'price' => 9.50],
            ],
        ],
        [
            'name' => 'BBQ Pit',
            'description' => 'Slow-smoked barbecue and classic Southern sides.',
            'location' => '340 Smokehouse Road',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Pulled Pork Plate', 'description' => 'Smoked pulled pork with two sides.', 'price' => 16.00],
                ['name' => 'Brisket Plate', 'description' => 'Slow-smoked brisket with two sides.', 'price' => 18.50],
                ['name' => 'Smoked Chicken Wings', 'description' => 'Half rack of smoked wings with house rub.', 'price' => 11.00],
                ['name' => 'Mac and Cheese', 'description' => 'Creamy baked mac and cheese.', 'price' => 6.00],
                ['name' => 'Cornbread', 'description' => 'Sweet cornbread served with honey butter.', 'price' => 4.00],
            ],
        ],
        [
            'name' => 'Thai Kitchen',
            'description' => 'Classic Thai dishes balancing sweet, sour, and spicy.',
            'location' => '19 Orchid Avenue',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Pad Thai', 'description' => 'Stir-fried rice noodles with egg, peanuts, and lime.', 'price' => 13.00],
                ['name' => 'Green Curry', 'description' => 'Coconut curry with chicken, bamboo, and basil.', 'price' => 14.50],
                ['name' => 'Tom Yum Soup', 'description' => 'Hot and sour soup with shrimp and lemongrass.', 'price' => 8.00],
                ['name' => 'Spring Rolls (4pc)', 'description' => 'Crispy rolls with sweet chili sauce.', 'price' => 6.50],
                ['name' => 'Mango Sticky Rice', 'description' => 'Sweet sticky rice with fresh mango and coconut milk.', 'price' => 7.00],
            ],
        ],
        [
            'name' => 'Mediterranean Grill',
            'description' => 'Grilled meats, fresh salads, and house-made dips.',
            'location' => '76 Olive Way',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Chicken Shawarma Wrap', 'description' => 'Marinated chicken, garlic sauce, and pickles.', 'price' => 11.50],
                ['name' => 'Falafel Plate', 'description' => 'Crispy falafel with hummus, salad, and pita.', 'price' => 12.00],
                ['name' => 'Greek Salad', 'description' => 'Tomato, cucumber, olives, and feta.', 'price' => 9.50],
                ['name' => 'Hummus and Pita', 'description' => 'Smooth hummus served with warm pita.', 'price' => 6.00],
                ['name' => 'Baklava', 'description' => 'Layered pastry with walnuts and honey syrup.', 'price' => 5.00],
            ],
        ],
        [
            'name' => 'Vegan Table',
            'description' => 'Plant-based comfort food made from scratch.',
            'location' => '9 Greenleaf Street',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Jackfruit Tacos', 'description' => 'Shredded jackfruit with slaw and chipotle crema.', 'price' => 11.00],
                ['name' => 'Buddha Bowl', 'description' => 'Quinoa, roasted vegetables, and tahini dressing.', 'price' => 12.50],
                ['name' => 'Vegan Mac and Cheese', 'description' => 'Cashew-based cheese sauce with elbow pasta.', 'price' => 10.50],
                ['name' => 'Lentil Soup', 'description' => 'Hearty lentil soup with carrots and celery.', 'price' => 6.50],
                ['name' => 'Chocolate Avocado Mousse', 'description' => 'Rich dairy-free chocolate mousse.', 'price' => 5.50],
            ],
        ],
        [
            'name' => 'Burger Joint',
            'description' => 'Classic smash burgers and crispy fries.',
            'location' => '142 Grill Street',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Classic Cheeseburger', 'description' => 'Beef patty, cheddar, lettuce, tomato, and onion.', 'price' => 10.50],
                ['name' => 'Bacon Burger', 'description' => 'Beef patty, bacon, cheddar, and BBQ sauce.', 'price' => 12.00],
                ['name' => 'Veggie Burger', 'description' => 'House-made black bean patty with chipotle aioli.', 'price' => 10.00],
                ['name' => 'Crispy Fries', 'description' => 'Golden fries with sea salt.', 'price' => 4.50],
                ['name' => 'Chocolate Milkshake', 'description' => 'Classic hand-spun chocolate milkshake.', 'price' => 5.50],
            ],
        ],
        [
            'name' => 'Seafood Shack',
            'description' => 'Fresh seafood favorites served dockside style.',
            'location' => '5 Pier Avenue',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Fish and Chips', 'description' => 'Beer-battered cod with fries and tartar sauce.', 'price' => 14.00],
                ['name' => 'Shrimp Po Boy', 'description' => 'Fried shrimp, lettuce, and remoulade on a baguette.', 'price' => 13.50],
                ['name' => 'Clam Chowder', 'description' => 'Creamy chowder with clams and potatoes.', 'price' => 7.50],
                ['name' => 'Crab Cakes (2pc)', 'description' => 'Pan-seared crab cakes with lemon aioli.', 'price' => 15.00],
                ['name' => 'Coleslaw', 'description' => 'Crisp cabbage slaw with a tangy dressing.', 'price' => 3.50],
            ],
        ],
        [
            'name' => 'Breakfast Nook',
            'description' => 'All-day breakfast and brunch classics.',
            'location' => '63 Sunrise Boulevard',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Classic Pancakes', 'description' => 'Three buttermilk pancakes with maple syrup.', 'price' => 8.50],
                ['name' => 'Veggie Omelette', 'description' => 'Three-egg omelette with peppers, onion, and cheese.', 'price' => 10.00],
                ['name' => 'Avocado Toast', 'description' => 'Sourdough toast with smashed avocado and chili flakes.', 'price' => 9.00],
                ['name' => 'Bacon and Eggs', 'description' => 'Two eggs any style with crispy bacon and toast.', 'price' => 9.50],
                ['name' => 'Fresh Orange Juice', 'description' => 'Freshly squeezed orange juice.', 'price' => 4.00],
            ],
        ],
        [
            'name' => 'Deli Corner',
            'description' => 'Classic sandwiches stacked high with fresh ingredients.',
            'location' => '27 Market Square',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Turkey Club', 'description' => 'Turkey, bacon, lettuce, tomato, and mayo on toast.', 'price' => 10.00],
                ['name' => 'Italian Sub', 'description' => 'Ham, salami, provolone, and Italian dressing.', 'price' => 10.50],
                ['name' => 'Pastrami on Rye', 'description' => 'Warm pastrami with mustard on rye bread.', 'price' => 11.00],
                ['name' => 'Chicken Caesar Wrap', 'description' => 'Grilled chicken, romaine, parmesan, and Caesar dressing.', 'price' => 9.50],
                ['name' => 'Kettle Chips', 'description' => 'Crunchy kettle-cooked potato chips.', 'price' => 2.50],
            ],
        ],
        [
            'name' => 'Bakery and Sweets',
            'description' => 'Fresh-baked pastries, cakes, and coffee.',
            'location' => '4 Baker Street',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Chocolate Croissant', 'description' => 'Buttery, flaky croissant with chocolate filling.', 'price' => 4.50],
                ['name' => 'Blueberry Muffin', 'description' => 'Moist muffin packed with fresh blueberries.', 'price' => 3.75],
                ['name' => 'Cinnamon Roll', 'description' => 'Warm cinnamon roll topped with cream cheese icing.', 'price' => 5.00],
                ['name' => 'Chocolate Chip Cookie', 'description' => 'Soft-baked cookie loaded with chocolate chips.', 'price' => 2.75],
                ['name' => 'Cafe Latte', 'description' => 'Espresso with steamed milk.', 'price' => 4.25],
            ],
        ],
        [
            'name' => 'Steakhouse',
            'description' => 'Hearty steaks and classic sides in a cozy setting.',
            'location' => '101 Prime Street',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Ribeye Steak', 'description' => '12oz ribeye grilled to order.', 'price' => 28.00],
                ['name' => 'Filet Mignon', 'description' => '8oz filet with a red wine reduction.', 'price' => 32.00],
                ['name' => 'Loaded Baked Potato', 'description' => 'Baked potato with cheddar, bacon, and sour cream.', 'price' => 6.50],
                ['name' => 'Grilled Asparagus', 'description' => 'Asparagus grilled with olive oil and sea salt.', 'price' => 6.00],
                ['name' => 'Caesar Salad', 'description' => 'Romaine, parmesan, croutons, and Caesar dressing.', 'price' => 8.00],
            ],
        ],
        [
            'name' => 'Ramen House',
            'description' => 'Rich, slow-simmered ramen broths and toppings.',
            'location' => '82 Lantern Alley',
            'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            'menu' => [
                ['name' => 'Tonkotsu Ramen', 'description' => 'Pork broth ramen with chashu and soft egg.', 'price' => 14.00],
                ['name' => 'Shoyu Ramen', 'description' => 'Soy-based broth with noodles, egg, and scallion.', 'price' => 13.50],
                ['name' => 'Spicy Miso Ramen', 'description' => 'Miso broth with chili oil and ground pork.', 'price' => 14.50],
                ['name' => 'Gyoza (6pc)', 'description' => 'Pan-fried pork dumplings with dipping sauce.', 'price' => 7.50],
                ['name' => 'Seaweed Salad', 'description' => 'Marinated seaweed with sesame seeds.', 'price' => 5.00],
            ],
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bistro = Restaurant::query()->updateOrCreate(
            ['name' => 'Bistro'],
            [
                'description' => 'Casual neighborhood restaurant with simple comfort food.',
                'location' => '123 Main Street',
                'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            ],
        );

        $tacoHouse = Restaurant::query()->updateOrCreate(
            ['name' => 'Taco House'],
            [
                'description' => 'Quick pickup spot for tacos, bowls, and sides.',
                'location' => '48 Market Avenue',
                'image_url' => 'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?auto=format&fit=crop&w=900&q=80',
            ],
        );

        $bistroBurger = $this->menuItem($bistro, 'Bistro Burger', 'Beef patty, cheddar, lettuce, and house sauce.', 14.50);
        $tomatoSoup = $this->menuItem($bistro, 'Tomato Soup', 'Slow-simmered tomato soup with basil.', 7.25);
        $gardenSalad = $this->menuItem($bistro, 'Garden Salad', 'Mixed greens, cucumber, tomato, and vinaigrette.', 9.00);

        $chickenTacos = $this->menuItem($tacoHouse, 'Chicken Tacos', 'Three soft tacos with salsa verde.', 12.00);
        $veggieBowl = $this->menuItem($tacoHouse, 'Veggie Bowl', 'Rice, beans, peppers, corn, and avocado crema.', 11.75);
        $chipsAndSalsa = $this->menuItem($tacoHouse, 'Chips and Salsa', 'House chips with mild tomato salsa.', 4.50);

        foreach (self::ADDITIONAL_RESTAURANTS as $seed) {
            $restaurant = Restaurant::query()->updateOrCreate(
                ['name' => $seed['name']],
                [
                    'description' => $seed['description'],
                    'location' => $seed['location'],
                    'image_url' => $seed['image_url'],
                ],
            );

            foreach ($seed['menu'] as $menuItem) {
                $this->menuItem($restaurant, $menuItem['name'], $menuItem['description'], $menuItem['price']);
            }
        }

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
                'image_url' => $restaurant->image_url ?: self::PLACEHOLDER_IMAGE,
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
