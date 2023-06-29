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
        $requestData = $request->all();

        // $modello = new Restaurant();

        // dd($modello->types());
    //     $result = DB::table('restaurants')
    // ->join('restaurant_type', 'restaurants.id', '=', 'restaurant_type.restaurant_id')
    // ->join('types', 'restaurant_type.type_id', '=', 'types.id')
    // ->where('types.id', 1)
    // ->select('restaurants.*')
    // ->get();

        $types = Type:: all();
        

        if($request->has('type_id') && $requestData['type_id']){
            $restaurant = Restaurant::with('dishes', 'types')
            ->select('restaurants.*')
            ->join('restaurant_type', 'restaurants.id', '=', 'restaurant_type.restaurant_id')
            ->join('types', 'restaurant_type.type_id', '=', 'types.id')
            ->whereIn('types.id', $requestData['type_id'] )
            ->distinct()
            ->paginate(3);

            if(count($restaurant) == 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'A questa tipologia non corrisponde nessun ristorante',
                ]);
            }
        }else{

            $restaurant = Restaurant::with('dishes', 'types')
                ->paginate(3);
            
        }
        
        return response()->json([
            'success' => true,
            'results' => $restaurant,
            'types' => $types
        ]);

        // if ($request->has('activity_name') && $formData['activity_name'] != "") {
        //     $restaurant = Restaurant::where('activity_name', 'like', "%$formData[activity_name]%")->get();
        // }
        // dd($formData);

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
