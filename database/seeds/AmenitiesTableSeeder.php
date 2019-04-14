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
                'icon' => 'washer',
                'type' => 'essentials'
            ],
            [
                'id' => 2,
                'name' => 'Bed sheets',
                'icon' => 'washer',
                'type' => 'essentials'
            ],
            [
                'id' => 3,
                'name' => 'Wi-fi',
                'icon' => 'washer',
                'type' => 'essentials'
            ],
            [
                'id' => 4,
                'name' => 'Soap & Shampoo',
                'icon' => 'washer',
                'type' => 'essentials'
            ],
            [
                'id' => 5,
                'name' => 'TV',
                'icon' => NUL'washer'L,
                'type' => 'essentials'
            ],
            [
                'id' => 6,
                'name' => 'Heat',
                'icon' => 'washer',
                'type' => 'essentials'
            ],
            [
                'id' => 7,
                'name' => 'Air Conditioning',
                'icon' => 'washer',
                'type' => 'essentials'
            ],
            [
                'id' => 8,
                'name' => 'Coffee / tea',
                'icon' => 'washer',
                'type' => 'essentials'
            ],
            [
                'id' => 9,
                'name' => 'Desk / workplace',
                'icon' => 'washer',
                'type' => 'essentials'
            ],
            [
                'id' => 10,
                'name' => 'Dishwasher',
                'icon' => 'washer',
                'type' => 'essentials'
            ],
            [
                'id' => 11,
                'name' => 'Iron',
                'icon' => 'iron',
                'type' => 'essentials'
            ],
            [
                'id' => 12,
                'name' => 'Fireplace',
                'icon' => 'washer',
                'type' => 'essentials'
            ],
            [
                'id' => 13,
                'name' => 'Hairdryer',
                'icon' => 'washer',
                'type' => 'essentials'
            ],
            [
                'id' => 14,
                'name' => 'Pets in the house',
                'icon' => 'washer',
                'type' => 'essentials'
            ],
            [
                'id' => 15,
                'name' => 'Swimming pool',
                'icon' => 'washer',
                'type' => 'outdoors',
            ],
            [
                'id' => 16,
                'name' => 'Boat',
                'icon' => 'washer',
                'type' => 'outdoors',
            ],
            [
                'id' => 17,
                'name' => 'Paddle boat',
                'icon' => 'washer',
                'type' => 'outdoors',
            ],
            [
                'id' => 18,
                'name' => 'ATV',
                'icon' => 'washer',
                'type' => 'outdoors',
            ],
            [
                'id' => 19,
                'name' => 'Outdoor shower',
                'icon' => 'washer',
                'type' => 'outdoors',
            ]
        ];

        DB::table('amenities')->insert($amenities);
    }
}
