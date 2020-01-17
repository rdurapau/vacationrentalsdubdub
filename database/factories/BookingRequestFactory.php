<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\BookingRequest::class, function (Faker $faker) {
    $createdAt = $faker->dateTimeBetween('-4 months', $endDate = 'now');
    $startDate = Carbon::instance($createdAt)->addDays(rand(10,200));
    $dateStr = $startDate->toFormattedDateString() . ' - ' . $startDate->addDays(rand(1,8))->toFormattedDateString();
    return [
        'name' => $faker->name(),
        'email' => $faker->email(),
        'phone' => $faker->phoneNumber(),
        'dates' => $dateStr,
        'created_at' => $createdAt
    ];
});