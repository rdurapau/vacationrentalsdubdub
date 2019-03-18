<?php

use Illuminate\Database\Seeder;

class AmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amenities = [
            [
                'id' => 1,
                'name' => 'Towels',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 2,
                'name' => 'Bed sheets',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 3,
                'name' => 'Wi-fi',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 4,
                'name' => 'Soap & Shampoo',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 5,
                'name' => 'TV',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 6,
                'name' => 'Heat',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 7,
                'name' => 'Air Conditioning',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 8,
                'name' => 'Coffee / tea',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 9,
                'name' => 'Desk / workplace',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 10,
                'name' => 'Dishwasher',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 11,
                'name' => 'Iron',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 12,
                'name' => 'Fireplace',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 13,
                'name' => 'Hairdryer',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 14,
                'name' => 'Pets in the house',
                'icon' => NULL,
                'type' => 'essentials'
            ],
            [
                'id' => 15,
                'name' => 'Swimming pool',
                'icon' => NULL,
                'type' => 'outdoors',
            ],
            [
                'id' => 16,
                'name' => 'Boat',
                'icon' => NULL,
                'type' => 'outdoors',
            ],
            [
                'id' => 17,
                'name' => 'Paddle boat',
                'icon' => NULL,
                'type' => 'outdoors',
            ],
            [
                'id' => 18,
                'name' => 'ATV',
                'icon' => NULL,
                'type' => 'outdoors',
            ],
            [
                'id' => 19,
                'name' => 'Outdoor shower',
                'icon' => NULL,
                'type' => 'outdoors',
            ]
        ];

        DB::table('amenities')->insert($amenities);
    }
}
