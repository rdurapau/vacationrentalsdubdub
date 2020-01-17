<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\ModerationStatus;

$factory->define(App\Amenity::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'type' => $faker->word()
    ];
});