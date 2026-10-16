<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Contracts\View\View;

class MenuItemController extends Controller
{
    public function show(Restaurant $restaurant, MenuItem $menuItem): View
    {
        return view('menu-items.show', [
            'restaurant' => $restaurant,
            'menuItem' => $menuItem,
        ]);
    }
}
