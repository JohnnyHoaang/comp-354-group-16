<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;

class DataDebugController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'restaurants' => Restaurant::query()->with('menuItems', 'orders.orderItems.menuItem')->get(),
            'menu_items' => MenuItem::query()->with('restaurant')->get(),
            'orders' => Order::query()->with('restaurant', 'orderItems.menuItem')->get(),
            'order_items' => OrderItem::query()->with('order.restaurant', 'menuItem.restaurant')->get(),
        ]);
    }

    public function restaurants(): JsonResponse
    {
        return response()->json(
            Restaurant::query()->with('menuItems', 'orders.orderItems.menuItem')->get(),
        );
    }

    public function menuItems(): JsonResponse
    {
        return response()->json(
            MenuItem::query()->with('restaurant')->get(),
        );
    }

    public function orders(): JsonResponse
    {
        return response()->json(
            Order::query()->with('restaurant', 'orderItems.menuItem')->get(),
        );
    }

    public function orderItems(): JsonResponse
    {
        return response()->json(
            OrderItem::query()->with('order.restaurant', 'menuItem.restaurant')->get(),
        );
    }
}
