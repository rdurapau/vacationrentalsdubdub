<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\ModerationStatus;

$factory->define(App\Spot::class, function (Faker $faker) {
    
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

$factory->state(App\Spot::class, 'pending', function (Faker $faker) {
    return [
        'moderated_by' => NULL,
        'moderated_at' => NULL,
        'moderation_status' => ModerationStatus::PENDING,
        'created_at' => $faker->dateTimeBetween('-2 weeks', $endDate = 'now')
    ];
});

$factory->state(App\Spot::class, 'rejected', [
    'moderation_status' => ModerationStatus::REJECTED
]);

$factory->afterCreatingState(App\Spot::class, 'has-requests', function ($spot, $faker) {
    factory('App\BookingRequest',rand(0,5))->create([
        'spot_id' => $spot->id
    ]);
});
