<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\ModerationStatus;

$factory->define(App\Submission::class, function (Faker $faker) {
    
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
        
        "sleeps" => rand(2,20),
        "beds" => rand(1,8),
        "baths" => rand(1,3),
        'lat' => $coords[0],
        'lng' => $coords[1],
        
        'moderated_by' => NULL,
        'moderated_at' => NULL,
        'moderation_status' => ModerationStatus::PENDING,
        'created_at' => $faker->dateTimeBetween('-2 weeks', $endDate = 'now')
    ];
});

$factory->afterCreating(App\Submission::class, function($spot, $faker) {
    // $amenities = range(1,19);
    $amenities = \App\Amenity::pluck('id')->toArray();
    if ($amenities) {
        $spot->amenities()->sync($faker->randomElements($amenities,rand(3,8)));
    }

    // Add one of the 19 exterior photos as the primary photo for this spot
    $mainPhotoNum = rand(1,19);
    $spot
        ->addMedia(storage_path('seeding-photos/exterior-'.$mainPhotoNum.'.png'))
        ->preservingOriginal()
        ->toMediaCollection();

    // Add some additional photos from the 39 interior photos
    $altPhotoNums = range(1,37);
    $altPhotos = $faker->randomElements($altPhotoNums,rand(0,6));
    foreach($altPhotos as $num) {
        $spot
            ->addMedia(storage_path('seeding-photos/interior-'.$num.'.png'))
            ->preservingOriginal()
            ->toMediaCollection();
    }
});

$factory->afterCreatingState(App\Spot::class, 'has-requests', function ($spot, $faker) {
    factory('App\BookingRequest',rand(0,5))->create([
        'spot_id' => $spot->id
    ]);
});
