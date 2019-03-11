<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\ModerationStatus;

$factory->define(App\BookingRequest::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'email' => $faker->email(),
        'phone' => $faker->phoneNumber(),
        'dates' => $faker->sentence(2),
        'created_at' => $faker->dateTimeBetween('-2 months', $endDate = 'now')
    ];
});