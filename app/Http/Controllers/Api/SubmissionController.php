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
        // $validated = $request->validate([
        //     'name' => 'required',
        //     'desc' => 'required',

        //     'address1' => 'required|string|max:255',
        //     'city' => 'required|string',
        //     'state' => 'required|string',
        //     'postal_code' => 'required',
        //     'lat' => 'required|numeric',
        //     'lng' => 'required|numeric',

        //     'email' => 'required|email',
        //     'phone' => 'required',
        //     'website' => 'nullable',
            
        //     'sleeps' => 'required|numeric',
        //     'baths' => 'required|numeric',
        //     'beds' => 'required|numeric',
        
        //     'photos' => 'array'
        // ]);

        // $spot = new BaseSpot($validated);
        // $spot->owner_id = $request->user()->id;
        // $spot->save();     

        
        // if (array_key_exists('photos', $validated) && count($validated['photos'])) {
        //     $photos = TempMedia::whereIn('id',$validated['photos'])
        //         ->with('media')
        //         ->get();

        //     foreach($photos as $photo) {
        //         $photo->getFirstMedia()->move($spot);
        //     }
        // }

        // Mail::to($spot->email)->send(new SpotSubmitted($spot->id));
        // broadcast(new SpotWasSubmitted($spot));

        // $this->setStatusCode(201);
        return response()->json($request->user());
    }

}