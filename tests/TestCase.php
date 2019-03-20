<?php

namespace Tests;

use App\Helpers\RandomCoordinates;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    public $apiRoot = '/api';

    public function setUp() : void 
    {
        parent::setUp();
        $this->seedAmenities();

    }

    protected function signIn($user = null, $guard = null)
    {
        $user = $user ? $user : create('App\User');

        $this->actingAs($user, $guard);
        
        Passport::actingAs(
            $user
        );

        return $this;
    }

    protected function getFakeSpotData($overrides = [])
    {
        $h = new RandomCoordinates;
        $coords = $h->getPoint();

        return array_merge ([
            'name' => $this->faker->sentence(3),
            'desc' => $this->faker->text(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'website' => $this->faker->url(),
            'price' => $this->faker->numberBetween(100,500),
            'address1' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'postal_code' => $this->faker->postcode(),
            'owner_name' => $this->faker->name(),
            'sleeps' => rand(2,18),
            'baths' => rand(2,4),
            'lat' => $coords[0],
            'lng' => $coords[1]
        ], $overrides);
    }

    protected function getFakeBookingRequestData($overrides = [])
    {
        $email = $this->faker->email();
        $startDate = Carbon::instance($this->faker->dateTimeBetween('now', '1 years'));
        $dates = $startDate->toFormattedDateString() . ' - ' . $startDate->addDays(rand(1,8))->toFormattedDateString();
    
        return array_merge ([
            'name' => $this->faker->sentence(3),
            'email' => $email,
            'email_confirmation' => $email,
            'phone' => $this->faker->phoneNumber(),
            'dates' => $dates
        ], $overrides);
    }

    protected function seedAmenities()
    {
        $this->artisan('db:seed --class=AmenitiesTableSeeder');
    }
}
