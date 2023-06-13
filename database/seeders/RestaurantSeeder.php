<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        for($i = 0; $i < 10; $i++) {

            $newRestaurant = new Restaurant();

            $newRestaurant->activity_name = $faker->company();
            $newRestaurant->slug = Str::slug($newRestaurant->activity_name, '-');
            $newRestaurant->phone_number = $faker->phoneNumber();
            $newRestaurant->address = $faker->address();
            $newRestaurant->vat = $faker->vat();
            $newRestaurant->cover_image = 'https://static.vecteezy.com/ti/vettori-gratis/p1/5359703-cibo-icone-pixel-perfetto-illustrazione-vettoriale.jpg';

            $newRestaurant->save();
            
        }

    }
}
