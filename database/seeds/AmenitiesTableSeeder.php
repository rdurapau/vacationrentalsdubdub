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
            ['id' => 1, 'name' => 'Bed linens','icon' => null,'type' => 'bed & bath','is_featured' => false],
            ['id' => 2, 'name' => 'Extra pillows & blankets','icon' => null,'type' => 'bed & bath','is_featured' => false],
            ['id' => 3, 'name' => 'Hangers','icon' => null,'type' => 'bed & bath','is_featured' => false],
            ['id' => 4, 'name' => 'Iron','icon' => null,'type' => 'bed & bath','is_featured' => false],
            ['id' => 5, 'name' => 'Closet / drawers','icon' => null,'type' => 'bed & bath','is_featured' => false],
            ['id' => 6, 'name' => 'Bath towels','icon' => null,'type' => 'bed & bath','is_featured' => false],
            ['id' => 7, 'name' => 'Toilet paper','icon' => null,'type' => 'bed & bath','is_featured' => false],
            ['id' => 8, 'name' => 'Hair dryer','icon' => null,'type' => 'bed & bath','is_featured' => false],
            ['id' => 9, 'name' => 'Soap','icon' => null,'type' => 'bed & bath','is_featured' => false],
            ['id' => 10, 'name' => 'Shampoo','icon' => null,'type' => 'bed & bath','is_featured' => false],
            ['id' => 11, 'name' => 'Toothpaste','icon' => null,'type' => 'bed & bath','is_featured' => false],
            ['id' => 12, 'name' => 'Air conditioning','icon' => 'air-conditioning','type' => 'household','is_featured' => true],
            ['id' => 13, 'name' => 'Kitchen','icon' => 'kitchen','type' => 'household','is_featured' => true],
            ['id' => 14, 'name' => 'Washing machine','icon' => 'washing-machine','type' => 'household','is_featured' => true],
            ['id' => 15, 'name' => 'Dryer','icon' => 'dryer','type' => 'household','is_featured' => true],
            ['id' => 16, 'name' => 'Pets in the house','icon' => 'pets-in-house','type' => 'household','is_featured' => true],
            ['id' => 17, 'name' => 'Coffee maker','icon' => null,'type' => 'kitchen & dining','is_featured' => false],
            ['id' => 18, 'name' => 'Coffee / tea','icon' => null,'type' => 'kitchen & dining','is_featured' => false],
            ['id' => 19, 'name' => 'Dishes & silverware','icon' => null,'type' => 'kitchen & dining','is_featured' => false],
            ['id' => 20, 'name' => 'Pots & pans','icon' => null,'type' => 'kitchen & dining','is_featured' => false],
            ['id' => 21, 'name' => 'Dishwasher','icon' => null,'type' => 'kitchen & dining','is_featured' => false],
            ['id' => 22, 'name' => 'Microwave','icon' => null,'type' => 'kitchen & dining','is_featured' => false],
            ['id' => 23, 'name' => 'Refrigerator','icon' => null,'type' => 'kitchen & dining','is_featured' => false],
            ['id' => 24, 'name' => 'Oven','icon' => null,'type' => 'kitchen & dining','is_featured' => false],
            ['id' => 25, 'name' => 'Stove','icon' => null,'type' => 'kitchen & dining','is_featured' => false],
            ['id' => 26, 'name' => 'Wifi','icon' => 'wifi','type' => 'entertainment & outdoors','is_featured' => true],
            ['id' => 27, 'name' => 'TV','icon' => 'television','type' => 'entertainment & outdoors','is_featured' => true],
            ['id' => 28, 'name' => 'Cable','icon' => null,'type' => 'entertainment & outdoors','is_featured' => false],
            ['id' => 29, 'name' => 'Movies','icon' => null,'type' => 'entertainment & outdoors','is_featured' => false],
            ['id' => 30, 'name' => 'Music','icon' => null,'type' => 'entertainment & outdoors','is_featured' => false],
            ['id' => 31, 'name' => 'Books','icon' => null,'type' => 'entertainment & outdoors','is_featured' => false],
            ['id' => 32, 'name' => 'Board games','icon' => null,'type' => 'entertainment & outdoors','is_featured' => false],
            ['id' => 33, 'name' => 'Playing cards','icon' => null,'type' => 'entertainment & outdoors','is_featured' => false],
            ['id' => 34, 'name' => 'Outdoor deck','icon' => null,'type' => 'entertainment & outdoors','is_featured' => false],
            ['id' => 35, 'name' => 'Fire pit','icon' => null,'type' => 'entertainment & outdoors','is_featured' => false],
            ['id' => 36, 'name' => 'Swimming pool','icon' => null,'type' => 'entertainment & outdoors','is_featured' => false],
            ['id' => 37, 'name' => 'Hot tub','icon' => null,'type' => 'entertainment & outdoors','is_featured' => false],
            ['id' => 38, 'name' => 'Smoke detector','icon' => null,'type' => 'safety','is_featured' => false],
            ['id' => 39, 'name' => 'Carbon monoxide detector','icon' => null,'type' => 'safety','is_featured' => false],
            ['id' => 40, 'name' => 'First aid kit','icon' => null,'type' => 'safety','is_featured' => false],
            ['id' => 41, 'name' => 'Fire extinguisher','icon' => null,'type' => 'safety','is_featured' => false]
        ];

        DB::table('amenities')->insert($amenities);
    }
}
