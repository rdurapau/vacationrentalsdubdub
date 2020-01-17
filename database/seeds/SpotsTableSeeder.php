<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class SpotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mail::fake();

        factory(App\Spot::class, 20)->states('has-requests')->create();

        factory(App\Spot::class, 10)->states('pending')->create();

        factory(App\Spot::class, 5)->states('rejected')->create();
    }
}
