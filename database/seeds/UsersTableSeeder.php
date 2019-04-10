<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Caleb White',
            'email' => 'matthewcaleb@gmail.com',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'name' => 'Josiah Platt',
            'email' => 'josiah@vega.studio',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'name' => 'Charles Williams',
            'email' => 'charles@vega.studio',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'name' => 'Jacob Morse',
            'email' => 'jacob@vega.studio',
            'password' => bcrypt('password')
        ]);
    }
}
