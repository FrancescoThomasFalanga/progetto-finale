<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use FakerRestaurant\Provider\it_IT\Restaurant as Restaurant;

use Faker\Generator as Faker;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Restaurant $restaurant, Faker $faker)
    {
        
        for ($i = 0; $i < 10; $i++) {

            $newDish = new Dish();
            
            $newDish->name = $this->get_random($restaurant);
            $newDish->slug = Str::slug($newDish->name, '-');
            $newDish->description = $faker->text();
            $newDish->price = rand(1,999)/100;
            $newDish->availability = true;
            $newDish->cover_image = 'https://static.vecteezy.com/ti/vettori-gratis/p1/5359703-cibo-icone-pixel-perfetto-illustrazione-vettoriale.jpg';

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
