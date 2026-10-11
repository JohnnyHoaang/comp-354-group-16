<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DataDebugController;

Route::get('/', function () {
    return view('welcome');
});

// PBI-02: (RunMiao)
Route::get('/restaurants', [RestaurantController::class, 'index'])
    ->name('restaurants.index');

// PBI-01: (ak)
Route::prefix('debug/data')->name('debug.data.')->group(function () {
    Route::get('/', [DataDebugController::class, 'index'])->name('index');
    Route::get('/restaurants', [DataDebugController::class, 'restaurants'])->name('restaurants');
    Route::get('/menu-items', [DataDebugController::class, 'menuItems'])->name('menu-items');
    Route::get('/orders', [DataDebugController::class, 'orders'])->name('orders');
    Route::get('/order-items', [DataDebugController::class, 'orderItems'])->name('orderItems');
});