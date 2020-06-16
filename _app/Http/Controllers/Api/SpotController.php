<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Spot;
use App\BaseSpot;
use App\TempMedia;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Resources\GeoSpot as GeoSpotResource;
use App\Http\Resources\GeoSpotCollection;
use App\Http\Resources\Spot as SpotResource;
use App\Http\Resources\SpotCollection;

use App\Mail\SpotCreatedAndApproved;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SpotController extends ApiController
{
    public function index(Request $request)
    {
        $spots = Spot::with('media')->get();
        if ($this->wantsGeoJson($request)) {
            return response()
                ->json(new GeoSpotCollection($spots))
                ->header('Content-Type', 'application/geo+json');
        } else {
            return response()
                ->json(new SpotCollection($spots))
                ->header('Content-Type', 'application/json');
        }
    }

    public function single(Request $request, Spot $spot)
    {
        $spot->load('media');
        if ($this->wantsGeoJson($request)) {
            return response()
                ->json(new GeoSpotResource($spot))
                ->header('Content-Type', 'application/geo+json');
        } else {
            return response()
                ->json(new SpotResource($spot))
                ->header('Content-Type', 'application/json');
        }
    }

    public function new(Request $request)
    {
        $validated = $request->validate([
            'address1' => 'required|string|max:255',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',

            'name' => 'required',
            'desc' => 'required',

            'sleeps' => 'required|numeric',
            'baths' => 'required|numeric',
            'beds' => 'required|numeric',
            'sqft' => 'required|numeric',
            
            'email' => 'required|email',
            'phone' => 'required',
            'website' => 'nullable',

            'photos' => 'array',
        ]);


        $spot = new Spot($validated);
        $spot->owner_id = $request->user()->id;
        $spot->save();
        $spot->update([ "moderation_status" => 0 ]);

         
        if (array_key_exists('photos', $validated) && count($validated['photos'])) {
            
            $photos = Media::whereIn('id', $validated['photos'])->get();

            foreach($photos as $photo) {
                $photo->move($spot);
            }
        }

        // Mail::to($spot->email)->send(new SpotSubmitted($spot->id));
        // broadcast(new SpotWasSubmitted($spot));
        
        $spot->update([ "moderation_status" => 0 ]);
        return response()->json($spot);
    }

    public function mySpots(Request $request)
    {
        return response()->json(BaseSpot::where('owner_id', Auth::id())->get());
    }
   
    public function update(Request $request, BaseSpot $spot)
    {
        $validated = $request->validate([
            'address1' => 'nullable|string|max:255',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'postal_code' => 'nullable',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',

            'name' => 'nullable',
            'desc' => 'nullable',

            'sleeps' => 'nullable|numeric',
            'baths' => 'nullable|numeric',
            'beds' => 'nullable|numeric',
            'sqft' => 'nullable|numeric',
            
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'website' => 'nullable',
        ]);

        $spot->update(array_filter($validated));

        // Mail::to($spot->email)->send(new SpotSubmitted($spot->id));
        // broadcast(new SpotWasSubmitted($spot));

        return response()->json($spot);
    }

    public function replacePhoto(Request $request)
    {
        $validated = $request->validate([
            'photo' => 'required',
            'media_id' => 'required',
            'spot_id' => 'required',
        ]);

        // hacky code
        $spot = Spot::find($validated['spot_id']);
        $new = Media::find($validated['media_id']);
        $original = Media::where('model_id', $validated['spot_id'])
            ->where('file_name', basename($validated['photo']))
            ->firstOrFail();

        $originalID = $original->id;
        $new->move($spot);
        $original->delete();
        $new->update(['id' => $originalID]);

        \Log::info($validated);
        \Log::info($original);
        \Log::info(basename($validated['photo']));

        
        
        return response()->json($validated);
    }
}