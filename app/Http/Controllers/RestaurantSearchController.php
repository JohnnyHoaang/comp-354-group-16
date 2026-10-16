<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RestaurantSearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $restaurants = Restaurant::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->get();

        return view('restaurants.index', [
            'restaurants' => $restaurants,
            'search' => $search,
        ]);
    }

    public function show(Restaurant $restaurant): View
    {
        $menuItems = $restaurant->menuItems()
            ->orderBy('name')
            ->get();

        $bestSellers = $restaurant->menuItems()
            ->whereHas('orderItems.order', function (Builder $query) use ($restaurant): void {
                $query->where('restaurant_id', $restaurant->id);
            })
            ->withSum([
                'orderItems as units_sold' => function (Builder $query) use ($restaurant): void {
                    $query->whereHas('order', function (Builder $orderQuery) use ($restaurant): void {
                        $orderQuery->where('restaurant_id', $restaurant->id);
                    });
                },
            ], 'quantity')
            ->orderByDesc('units_sold')
            ->orderBy('name')
            ->limit(3)
            ->get();

        return view('restaurants.show', [
            'restaurant' => $restaurant,
            'menuItems' => $menuItems,
            'bestSellers' => $bestSellers,
        ]);
    }
}
