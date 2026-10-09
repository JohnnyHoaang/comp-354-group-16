<?php

use App\Http\Controllers\DataDebugController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('debug/data')->name('debug.data.')->group(function () {
    Route::get('/', [DataDebugController::class, 'index'])->name('index');
    Route::get('/restaurants', [DataDebugController::class, 'restaurants'])->name('restaurants');
    Route::get('/menu-items', [DataDebugController::class, 'menuItems'])->name('menu-items');
    Route::get('/orders', [DataDebugController::class, 'orders'])->name('orders');
    Route::get('/order-items', [DataDebugController::class, 'orderItems'])->name('order-items');
});
