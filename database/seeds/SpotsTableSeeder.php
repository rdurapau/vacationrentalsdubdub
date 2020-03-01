<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Seeder;
use App\Spot;

class SpotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Spot::class, 10)->states('approved')->create();
        factory(Spot::class, 5)->states('pending')->create();
    }
}
