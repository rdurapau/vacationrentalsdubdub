<?php

namespace App\Http\Controllers;

use Auth;
use App\Spot;
use App\BaseSpot;
use App\Amenity;
use App\EditToken;
use App\TempMedia;
use App\Http\Resources\Spot as SpotResource;

use App\Mail\SpotSubmitted;
use App\Events\SpotWasSubmitted;
use App\Events\SpotWasUpdated;

use Whitecube\NovaPage\Pages\Manager as NovaPageManager;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Str;

class SpotController extends Controller
{
    
    public function mySpots(Request $request)
    {
        return response()->json(BaseSpot::where('owner_id', Auth::id())->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            
            'email' => 'required|email',
            'phone' => 'required',
            'website' => 'nullable',

            'photos' => 'array',
        ]);


        $spot = new Spot($validated);
        $spot->owner_id = $request->user()->id;
        $spot->isPending();
        $spot->save();

         
        if (array_key_exists('photos', $validated) && count($validated['photos'])) {
            $photos = TempMedia::whereIn('id', $validated['photos'])
                ->with('media')
                ->get();

            foreach($photos as $photo) {
                $photo->getFirstMedia()->move($spot);
            }
        }

        // Mail::to($spot->email)->send(new SpotSubmitted($spot->id));
        // broadcast(new SpotWasSubmitted($spot));

        return response()->json($spot);
    }

    // public function update(Request $request, BaseSpot $spot)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required',
    //         'desc' => 'required',
            
    //         'sleeps' => 'required|numeric',
    //         'baths' => 'required|numeric',
    //         'beds' => 'required|numeric',

    //         'website' => 'required|url',
    //         'phone' => 'required',
    //     ]);

    //     $spot->update($validated);

    //     return response()->json($spot);
    // }

    // public function updateAddress(Request $request, BaseSpot $spot)
    // {
    //     $validated = $request->validate([
    //         'address1' => 'required|string|max:255',
    //         'city' => 'required|string',
    //         'state' => 'required|string',
    //         'postal_code' => 'required',
    //         'lat' => 'required|numeric',
    //         'lng' => 'required|numeric',
    //     ]);

    //     $spot->update($validated);

    //     return response()->json($spot);
    // }

    
    
    
    
    
    
    
    
    
    //// OLD
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, NovaPageManager $page)
    {
        if ($request->has('spot')) {
            $initSpot = $request->get('spot');
        } else {
            $initSpot = false;
        }

        $staticContent = [
            'tos' => [
                'heading' => $page->option('termsOfService')->heading,
                'body' => $page->option('termsOfService')->body,
            ],
            'about' => [
                'heading' => $page->option('about')->heading,
                'body' => $page->option('about')->body,
            ]
        ];

        // dd(json_encode($staticContent));
        // dd($staticContent);

        $amenities = Amenity::all();

        return view('spots.index', compact('amenities', 'initSpot','staticContent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amenities = Amenity::all();
        return view('spots.create', compact('amenities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function show(Spot $spot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function _edit(BaseSpot $spot)
    {
        $editTokenID = EditToken::insert([
            'token' => str_random(30),
            'spot_id' => $spot->id,
            'expires_at' => Carbon::now()->add(1, 'day')->toDateTimeString(),
        ]);
        $editToken = EditToken::find($editTokenID);
        $amenities = Amenity::all();
        $spotJson = $spot->append('amenity_ids')->append('images')->toJson();
        $spotJson = new SpotResource($spot, true);

        return view('spots.edit', compact('spotJson', 'editToken', 'amenities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spot  $spot
     * @param  \App\EditToken  $editToken
     * @return \Illuminate\Http\Response
     */
    public function edit(BaseSpot $spot, EditToken $editToken)
    {
        if ($editToken->spot_id != $spot->id) {
            return false;
        }

        // return $spot->getFirstMedia()->toArray();

        $amenities = Amenity::all();
        $spotJson = $spot->append('amenity_ids')->append('images')->toJson();
        $spotJson = new SpotResource($spot, true);

        // return $amenities;
        // return $spotJson;
        return view('spots.edit', compact('spotJson', 'editToken', 'amenities'));
    }

    /**
     * Update the specified resource in storage.
     * ! This is deprecated in favor of an API endpoint
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, BaseSpot $spot)
    // {
    //     $validated = $request->validate([
    //         'email' => 'required|email',
    //         'name' => 'required',
    //         'phone' => 'required',
    //         'website' => 'required|url',
    //         'desc' => 'required',
    //         'price' => 'required|numeric|min:10',
    //         'address1' => 'required|string|max:255',
    //         'city' => 'required|string',
    //         'state' => 'required|string',
    //         'postal_code' => 'required',
    //         'owner_name' => 'required',
    //         'lat' => 'required|numeric',
    //         'lng' => 'required|numeric',
    //         'amenities' => 'array',
    //         'sleeps' => 'required|numeric',
    //         'baths' => 'required|numeric',
    //         'edit_token' => [
    //             'required',
    //             Rule::in($spot->editTokens->pluck('token'))
    //         ]
    //     ]);

    //     $spot->update($validated);
    //     if (array_key_exists('amenities', $validated) && count($validated['amenities'])) {
    //         $amenities = array_keys($validated['amenities']);
    //     } else {
    //         $amenities = [];
    //     }
    //     $spot->amenities()->sync($amenities);
    //     // Mail::to($spot->email)->send(new SpotSubmitted($spot->id));
    //     broadcast(new SpotWasUpdated($spot));

    //     return back();
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spot $spot)
    {
        //
    }
}
