<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'giapponese',
                'icon_path' => 'sushi.png'
            ],
            [
                'name' => 'cinese',
                'icon_path' => 'buns.png'
            ],
            [
                'name' => 'osteria',
                'icon_path' => 'wine-bottle.png'
            ],
            [
                'name' => 'trattoria',
                'icon_path' => 'churrasco.png'
            ],
            [
                'name' => 'messicano',
                'icon_path' => 'taco.png'
            ],
            [
                'name' => 'pizzeria',
                'icon_path' => 'pizza.png'
            ],
            [
                'name' => 'fast food',
                'icon_path' => 'burger.png'
            ],
            [
                'name' => 'pub',
                'icon_path' => 'beer.png'
            ],
            [
                'name' => 'tailandese',
                'icon_path' => 'grasshopper.png'
            ],
        ];

        foreach($types as $type) {

            $newType = new Type();

            $newType->name = $type['name'];
            $newType->icon_path = $type['icon_path'];

            $newType->save();

        }
    }
}
