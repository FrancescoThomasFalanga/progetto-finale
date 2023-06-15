<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
        $restaurant = Restaurant::where('user_id', $user)->first();
        $restaurantID = $restaurant->id;
        $dishes = Dish::where('restaurant_id', $restaurantID)->get();

        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Dish $dish)
    {

        return view('admin.dishes.create', compact('dish'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::id();
        $restaurant = Restaurant::where('user_id', $user)->first();
        $restaurantID = $restaurant->id;
        $dishes = Dish::where('restaurant_id', $restaurantID)->get();

        $formData = $request->all();

        $dish = new Dish();

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('restaurantImages', $request->cover_image);
            $formData['cover_image'] = $path;
        }

        $dish->fill($formData);

        $dish->slug = Str::slug($formData['name'], '-');

        $dish->restaurant_id = $restaurantID;

        $dish->save();

        return redirect()->route('admin.dishes.index', compact('dishes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {

        $user = Auth::id();
        $restaurant = Restaurant::where('user_id', $user)->first();
        $restaurantID = $restaurant->id;
        $dishes = Dish::where('restaurant_id', $restaurantID)->first();
        
        if($dishes == null) {

            return redirect()->route('admin.notFound');

        } else {

            return view('admin.dishes.edit', compact('dish'));

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {

        $user = Auth::id();
        $restaurant = Restaurant::where('user_id', $user)->first();
        $restaurantID = $restaurant->id;
        $dishes = Dish::where('restaurant_id', $restaurantID)->get();

        $formData = $request->all();
        
        // dd($formData);

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('restaurantImages', $request->cover_image);
            $formData['cover_image'] = $path;
        }

        $dish->slug = Str::slug($formData['name'], '-');

        $dish->update($formData);


        return redirect()->route('admin.dishes.index', compact('dishes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {

        if($dish->cover_image){
            Storage::delete($dish->cover_image);
        }
        
        $dish->delete();

        return redirect()->route('admin.dishes.index');
    }
}
