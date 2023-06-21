<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant)
    {

        $user_id = Auth::id();
        $restaurants = Restaurant::where('user_id', $user_id)->first();

        if($restaurants == null) {

            $types = Type::all();

            return view('admin.restaurants.create', compact('types'));

        } else {
    
            return view('admin.restaurants.index', compact('restaurants'));

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $restaurant)
    {
        $types = Type::all();

        if ($restaurant->firstWhere('user_id', Auth::id())) {
            return redirect()->route('admin.restaurants.index');
        } else {
            return view('admin.restaurants.create', compact('types'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();

        $this->validation($formData);

        $restaurant = new Restaurant();

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('restaurantImages', $request->cover_image);
            $formData['cover_image'] = $path;
        }

        $restaurant->fill($formData);
        $restaurant->user_id = Auth::id();
        $restaurant->slug = Str::slug($restaurant->activity_name, '-');

        $restaurant->save();

        if (array_key_exists('types', $formData)) {
            $restaurant->types()->attach($formData['types']);
        }

        return redirect()->route('admin.restaurants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }

    private function validation($formData) {

        $validator = Validator::make($formData,
        [
            'activity_name'=> 'required',
            'phone_number'=> 'required|max:50|unique:restaurants,phone_number',
            'address'=> 'required',
            'vat'=> 'required|min:11|max:15|unique:restaurants,vat',
            'cover_image'=>'required|image|max:4096',
            'types' => 'required|array',
            'types.*' => 'exists:types,id',
        ],
        [
            'activity_name.required'=> 'Questo campo non può essere lasciato vuoto',
            'phone_number.required'=> 'Questo campo non può essere lasciato vuoto',
            'phone_number.max'=> 'Numero di telefono troppo lungo',
            'phone_number.unique' => 'Il numero di telefono è già stato preso',
            'address' => 'Questo campo non può essere lasciato vuoto',
            'vat.required' => 'Questo campo non può essere lasciato vuoto',
            'vat.min' => 'La partita IVA non deve essere inferiore a 11 caratteri',
            'vat.max' => 'La partita IVA non deve superare i 15 caratteri',
            'vat.unique' => 'Non puoi usare questa partita IVA',
            'cover_image.required' => "Devi caricare un'immagine",
            'cover_image.image' => 'Il file deve essere una immagine',
            'cover_image.max' =>  'Il file è troppo grande',
            'types.required' => 'Questo campo non può essere lasciato vuoto',
            'types.exists' => 'Il valore non è presente',
        ])->validate();

        return $validator;

    }
}
