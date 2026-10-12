<?php

use App\Http\Controllers\RestaurantSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/restaurants', [RestaurantSearchController::class, 'index'])
    ->name('restaurants.index');
