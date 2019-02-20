<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\ModerationStatus;

$factory->define(App\Spot::class, function (Faker $faker) {
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
        'moderated_by' => 1,
        'moderated_at' => $faker->dateTimeBetween('-2 years', $endDate = 'now'),
        'moderation_status' => ModerationStatus::APPROVED
    ];
});

$factory->state(App\Spot::class, 'pending', [
    'moderated_by' => NULL,
    'moderated_at' => NULL,
    'moderation_status' => ModerationStatus::PENDING
]);

$factory->state(App\Spot::class, 'rejected', [
    'moderation_status' => ModerationStatus::REJECTED
]);
