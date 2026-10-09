<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $restaurants = Restaurant::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        return view('restaurants.index', [
            'restaurants' => $restaurants,
            'search' => $search,
        ]);
    }
}