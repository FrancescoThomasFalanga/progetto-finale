<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatController extends Controller
{
    public function index() {

        $user_id = Auth::id();
        $restaurant = Restaurant::where('user_id', $user_id)->first();
        $restaurantID = $restaurant->id;
        
        $orders = Order::with('dishes')
        ->select('orders.*')
        ->join('dish_order', 'orders.id', '=', 'dish_order.order_id')
        ->join('dishes', 'dish_order.dish_id', '=', 'dishes.id')
        ->where('dishes.restaurant_id', $restaurantID )
        ->distinct()
        ->get();
    
    
        return view('admin/stats/index', compact('orders'));

    }
}
