<?php

namespace App\Http\Controllers\Api;

use App\Submission;
use App\BaseSpot;
use App\TempMedia;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Resources\GeoSpot as GeoSpotResource;
use App\Http\Resources\GeoSpotCollection;
use App\Http\Resources\Spot as SpotResource;
use App\Http\Resources\SpotCollection;

use App\Mail\SpotSubmitted;
use App\Events\SpotWasSubmitted;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubmissionController extends ApiController
{
    public function store(Request $request)
    {
        // return $request->all();
        // $values = $request->all();
        // dd($values['amenities']);

        $validated = $request->validate([
            'email' => 'required|confirmed|email',
            'name' => 'required',
            'phone' => 'required',
            'website' => 'nullable',
            'desc' => 'required',
            'price' => 'required|numeric|min:10|max:1000',
            'address1' => 'required|string|max:255',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required',
            'owner_name' => 'required',
            'sleeps' => 'required|numeric',
            'baths' => 'required|numeric',
            'beds' => 'required|numeric',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            
            'amenity_ids' => 'array',
            'photos' => 'array'
        ]);

        // dump($validated);

        $spot = Submission::create($validated);

        if (array_key_exists('amenity_ids', $validated) && count($validated['amenity_ids'])) {
            // dump($validated['amenity_ids']);
            $spot->amenities()->sync($validated['amenity_ids']);
        }

        if (array_key_exists('photos', $validated) && count($validated['photos'])) {
            // Move the TempPhotos over
            $photos = TempMedia::whereIn('id',$validated['photos'])
                ->with('media')
                ->get();

            foreach($photos as $photo) {
                $photo->getFirstMedia()->move($spot);
            }
        }

        Mail::to($spot->email)->send(new SpotSubmitted($spot->id));
        broadcast(new SpotWasSubmitted($spot));

        $this->setStatusCode(201);
        return $this->respond(['id'=>$spot->id]);
    }

}