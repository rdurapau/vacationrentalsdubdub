<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class RealSpotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mail::fake();
        
        $spots = [
            [
                'name' => 'Gorgeous Modern Farmhouse',
                'desc' => 'Curabitur blandit tempus porttitor. Vestibulum id ligula porta felis euismod semper. Cras justo odio, dapibus ac facilisis in, egestas eget quam.',
                'price' => 125,
                'address1' => '2420 Fieldlark Drive',
                'city' => 'Plano',
                'state' => 'TX',
                'postal_code' => '75074',
                'beds' => 5,
                'baths' => 4,
                'sleeps' => 13,
                'lng' => -96.6801270,
                'lat' => 33.0473090
            ],
            [
                'name' => 'Spacious Weekend Escape',
                'desc' => 'Cras mattis consectetur purus sit amet fermentum. Maecenas faucibus mollis interdum. Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.',
                'price' => 98,
                'address1' => '105 Haven Place',
                'city' => 'Allen',
                'state' => 'TX',
                'postal_code' => '75002',
                'beds' => 4,
                'baths' => 3,
                'sleeps' => 8,
                'lng' => -96.6266870,
                'lat' => 33.0995580
            ],
            [
                'name' => 'Cute little thing',
                'desc' => 'Cras mattis consectetur purus sit amet fermentum. Maecenas faucibus mollis interdum. Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.',
                'price' => 98,
                'address1' => '2408 Winona Dr',
                'city' => 'Plano',
                'state' => 'TX',
                'postal_code' => '75074',
                'beds' => 4,
                'baths' => 2,
                'sleeps' => 6,
                'lng' => -96.681375,
                'lat' => 33.041242
            ]
        ];
        foreach ($spots as $spot) {
            factory('App\Spot')->create($spot);    
        }
    }
}
