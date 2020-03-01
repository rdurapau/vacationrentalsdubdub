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
        'website' => 'https://google.com',
        'email' => 'owner@gmail.com',
        
        'sleeps' => rand(2,20),
        'beds' => rand(1,8),
        'baths' => rand(1,3),
        'sqft' => rand(500,3000),

        'address1' => $faker->streetAddress(),
        'state' => $faker->stateAbbr(),
        'city' => $faker->city(),
        'postal_code' => $faker->postcode(),
        'lat' => $coords[0],
        'lng' => $coords[1],
        
        'owner_id' => 1,
        'moderated_by' => 1,
        'moderated_at' => $faker->dateTimeBetween('-1 years', $endDate = 'now'),
        'moderation_status' => ModerationStatus::APPROVED,
        'created_at' => $faker->dateTimeBetween('-1 years', $endDate = 'now')
    ];
});

$factory->state(App\Spot::class, 'rejected', [
    'moderation_status' => ModerationStatus::REJECTED
]);

$factory->afterCreating(App\Spot::class, function($spot, $faker) {
    for ($i = 0; $i < rand(6, 19); $i++) { 
        $mainPhotoNum = rand(1,19);
        $spot
            ->addMedia(storage_path('seeding-photos/exterior-'.$mainPhotoNum.'.jpeg'))
            ->preservingOriginal()
            ->toMediaCollection();
    }

    // Add some additional photos from the 39 interior photos
    $altPhotoNums = range(6,37);
    $altPhotos = $faker->randomElements($altPhotoNums,rand(0,6));
    foreach($altPhotos as $num) {
        $spot
            ->addMedia(storage_path('seeding-photos/interior-'.$num.'.jpeg'))
            ->preservingOriginal()
            ->toMediaCollection();
    }
});

$factory->afterCreatingState(App\Spot::class, 'has-photo', function ($spot, $faker) {
    $spot
        ->addMediaFromUrl($faker->image('/tmp', 640, 480, 'city'))
        ->toMediaCollection();
});

$factory->afterCreatingState(App\Spot::class, 'rejected', function ($spot, $faker) {
    $spot->moderation_status = ModerationStatus::REJECTED;
    $spot->save();
});
