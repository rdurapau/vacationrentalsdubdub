<?php

use Illuminate\Database\Seeder;

class SpotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Spot::class, 20)->create();

        factory(App\Spot::class, 10)->states('pending')->create();

        factory(App\Spot::class, 5)->states('rejected')->create();
    }
}
