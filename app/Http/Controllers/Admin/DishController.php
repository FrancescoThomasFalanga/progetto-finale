<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
        $dishes = Dish::where('restaurant_id', $restaurantID)->orderBy('name','asc')->get();

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

        $this->validation($formData);

        $dish = new Dish();

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('restaurantImages', $request->cover_image);
            $formData['cover_image'] = $path;
        } else {

            $formData['cover_image'] = 'https://static.vecteezy.com/ti/vettori-gratis/p1/5359703-cibo-icone-pixel-perfetto-illustrazione-vettoriale.jpg';

        }

        $dish->fill($formData);

        $dish->slug = Str::slug($formData['name'], '-');

        $dish->restaurant_id = $restaurantID;

        if(array_key_exists('intolerance', $formData)){
            $intolerances = $formData['intolerance'];
            
            $stringIntolerances = implode(", ",$intolerances);
            $dish->intolerance = $stringIntolerances;
        }

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

        $isTheSame = $dish->restaurant->user_id;

        // dd($dish);
        
        if($isTheSame != $user) {

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

        $this->validation($formData);

        if ($request->hasFile('cover_image')) {

            if ($dish->cover_image) {
                Storage::delete($dish->cover_image);
            }

            $path = Storage::put('restaurantImages', $request->cover_image);
            $formData['cover_image'] = $path;
        }

        $dish->slug = Str::slug($formData['name'], '-');

        $dish->update($formData);

        if(array_key_exists('intolerance', $formData)) {

            
            $intolerances = $formData['intolerance'];

            
            $stringIntolerances = implode(", ",$intolerances);
            $dish->intolerance = $stringIntolerances;
            
        } else{

            $formData['intolerance'] = null;
            $dish->intolerance =$formData['intolerance'];
            
        }

        $dish->save();

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

    private function validation($formData) {

        $validator = Validator::make($formData,
        [
            'name'=> 'required|max:125|',
            'description'=> 'nullable',
            'price'=> 'required|decimal:2|min:0|max:999.99',
            'availability'=> 'required',
            'intolerance'=>'nullable',
            'cover_image'=>'image|max:4096',
            'restaurant_id' => 'exists:restaurants,id'
        ],
        [
            'name.required'=> 'Questo campo non può essere lasciato vuoto',
            'name.max'=> 'Questo campo può avere massimo 125 caratteri',
            'price.required'=> 'Questo campo non può essere lasciato vuoto',
            'price.decimal'=> 'Specificare due cifre decimali',
            'price.min' => 'Il numero deve essere positivo',
            'price.max' => 'Il prezzo massimo può essere 999.99',
            'availability.required' => 'Questo campo non può essere lasciato vuoto',
            'restaurant_id.exists'=>'Questo campo non è ammesso',
            'cover_image.image' => 'Il file deve essere una immagine',
            'cover_image.max' =>  'Il file è troppo grande',
        ])->validate();

        return $validator;

    }
}
