<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use FakerRestaurant\Provider\it_IT\Restaurant as Restaurant;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Restaurant $restaurant)
    {
        
        for ($i = 0; $i < 10; $i++) {

            $newDish = new Dish();

            // $newDish->name = $restaurant->foodName();
            $newDish->name = $this->get_random($restaurant);
            $newDish->slug = 'aaaaa';
            $newDish->description = 'aaaaa';
            $newDish->price = 5.2;
            $newDish->availability = true;
            $newDish->intolerance = 'aaaaa';
            $newDish->cover_image = 'aaaaa';

            $newDish->save();

        }

    }

    private function get_random($restaurant) {

        $scelta = ['food', 'beverage'][array_rand(['food','beverage'])];

        if ($scelta == 'food') {

            return $restaurant->foodName();

        } else {

            return $restaurant->beverageName();

        }

    }
}
