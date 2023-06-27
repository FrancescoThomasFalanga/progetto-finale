<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class DishApiController extends Controller
{
    public function index(Request $request,  $slug)
    {
        // dd($restaurantID);
        $restaurant = Restaurant::where('slug',  $slug)->first();
        $restaurantID = $restaurant->id;
        $dishes = Dish::where('restaurant_id', $restaurantID)->orderBy('name', 'asc')->get();

        return response()->json([
            'success' => true,
            'results' => $dishes,
        ]);
    }
}
