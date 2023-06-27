<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatController extends Controller
{
    public function index() {

        $user_id = Auth::id();
        $restaurants = Restaurant::where('user_id', $user_id)->first();

        if ($restaurants == null) {

            $types = Type::all();

            return view('admin.restaurants.create', compact('types'));

        } else {

            $restaurantID = $restaurants->id;

            $total = Order::select('orders.*')
            ->join('dish_order', 'orders.id', '=', 'dish_order.order_id')
            ->join('dishes', 'dish_order.dish_id', '=', 'dishes.id')
            ->where('dishes.restaurant_id', $restaurantID)
            ->distinct('dish_order.order_id')
            ->get();
    
            $orders = Order::selectRaw('COUNT(DISTINCT dish_order.order_id) as total, DATE_FORMAT(orders.created_at, "%b %Y") as date')
            ->join('dish_order', 'orders.id', '=', 'dish_order.order_id')
            ->join('dishes', 'dish_order.dish_id', '=', 'dishes.id')
            ->where('dishes.restaurant_id', $restaurantID)
            ->groupBy('date')
            ->get();

            $orderCounts = [];
            foreach ($orders as $order) {
                $orderCounts[] = [
                    'total' => $order->total,
                    'date' => $order->date,
                ];
            }
            
            // dd($orderCounts);

            return view('admin/stats/index', compact( 'orderCounts', 'total'));

        };



    }
}
