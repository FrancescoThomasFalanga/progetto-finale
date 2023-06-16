<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class RestaurantApiController extends Controller
{
    public function index(Request $request)
    {
        $restaurant = Restaurant::with('dishes', 'types')
            ->paginate(6);
        // $formData = $request->all();

        // if ($request->has('activity_name') && $formData['activity_name'] != "") {
        //     $restaurant = Restaurant::where('activity_name', 'like', "%$formData[activity_name]%")->get();
        // }
        $types = Type:: all();
        return response()->json([
            'success' => true,
            'results' => $restaurant,
            'types' => $types
        ]);
    }
    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->with('dishes', 'types')->first();

        return response()->json([
            'success' => true,
            'results' => $restaurant
        ]);
    }
}
