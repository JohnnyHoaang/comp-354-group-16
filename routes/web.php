<?php

use App\Http\Controllers\DataDebugController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\RestaurantSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RestaurantSearchController::class, 'index'])->name('restaurants.index');

Route::prefix('debug/data')->name('debug.data.')->group(function () {
    Route::get('/', [DataDebugController::class, 'index'])->name('index');
    Route::get('/restaurants', [DataDebugController::class, 'restaurants'])->name('restaurants');
    Route::get('/menu-items', [DataDebugController::class, 'menuItems'])->name('menu-items');
    Route::get('/orders', [DataDebugController::class, 'orders'])->name('orders');
    Route::get('/order-items', [DataDebugController::class, 'orderItems'])->name('order-items');
});

Route::get('/restaurants/{restaurant}', [RestaurantSearchController::class, 'show'])
    ->name('restaurants.show');

Route::get('/restaurants/{restaurant}/menu/{menuItem}', [MenuItemController::class, 'show'])
    ->scopeBindings()
    ->name('restaurants.menu-items.show');
