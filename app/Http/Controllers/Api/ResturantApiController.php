<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ResturantApiController extends Controller
{
    public function index(Request $request)
    {
        $restaurant = Restaurant::with('dishes', 'types')
            ->paginate(6);
        // $formData = $request->all();

        // if ($request->has('activity_name') && $formData['activity_name'] != "") {
        //     $restaurant = Restaurant::where('activity_name', 'like', "%$formData[activity_name]%")->get();
        // }

        return response()->json([
            'success' => true,
            'results' => $restaurant,
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
