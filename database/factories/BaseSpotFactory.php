<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\ModerationStatus;

$factory->define(App\BaseSpot::class, function (Faker $faker) {
    
    $h = new \App\Helpers\RandomCoordinates;
    $coords = $h->getPoint();

    return [
        'name' => $faker->sentence(3),
        'desc' => $faker->text(),
        'email' => $faker->email(),
        'phone' => $faker->phoneNumber(),
        'website' => $faker->url(),
        'price' => $faker->numberBetween(100,500),
        'address1' => $faker->streetAddress(),
        'city' => $faker->city(),
        'state' => $faker->stateAbbr(),
        'postal_code' => $faker->postcode(),
        'owner_name' => $faker->name(),
        'lat' => $coords[0],
        'lng' => $coords[1],
        'moderated_by' => 1,
        'moderated_at' => $faker->dateTimeBetween('-1 years', $endDate = 'now'),
        'moderation_status' => ModerationStatus::APPROVED,
        'created_at' => $faker->dateTimeBetween('-1 years', $endDate = 'now')
    ];
});