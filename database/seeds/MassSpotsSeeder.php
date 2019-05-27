<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class MassSpotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mail::fake();
        factory(App\Spot::class, 200)->create();
    }
}
