<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\ModerationStatus;

$factory->define(App\EditToken::class, function (Faker $faker) {
    return [
        'token' => str_random(30),
        'expires_at' => $faker->dateTimeBetween('now', '1 years')
    ];
});