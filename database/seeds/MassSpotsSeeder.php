<?php

use Illuminate\Database\Seeder;

class MassSpotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Spot::class, 200)->create();
    }
}
