<?php

namespace App\Http\Controllers;

use App\Spot;
use App\BaseSpot;
use App\Amenity;
use App\EditToken;
use App\Http\Resources\Spot as SpotResource;

use App\Mail\SpotSubmitted;
use App\Events\SpotWasSubmitted;
use App\Events\SpotWasUpdated;

use Whitecube\NovaPage\Pages\Manager as NovaPageManager;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class SpotController extends Controller
{
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

        $amenities = Amenity::all();

        return view('app.index', compact('amenities', 'initSpot','staticContent'));
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
     * Store a newly created resource in storage.
     * ! This is deprecated in favor of an API endpoint
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required',
            'website' => 'nullable',
            'desc' => 'required',
            'price' => 'required|numeric|min:10',
            'address1' => 'required|string|max:255',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required',
            'owner_name' => 'required',
            'amenities' => 'array',
            'sleeps' => 'required|numeric',
            'baths' => 'required|numeric',
            'beds' => 'required|numeric',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);

        $spot = Spot::create($validated);

        if (array_key_exists('amenities', $validated) && count($validated['amenities'])) {
            $spot->amenities()->sync(array_keys($validated['amenities']));
        }

        Mail::to($spot->email)->send(new SpotSubmitted($spot->id));
        broadcast(new SpotWasSubmitted($spot));

        return back();
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
     * @param  \App\EditToken  $editToken
     * @return \Illuminate\Http\Response
     */
    public function edit(BaseSpot $spot, EditToken $editToken)
    {
        if ($editToken->spot_id != $spot->id) {
            return 'Bad Edit token';
        }

        $amenities = Amenity::all();
        $spotJson = $spot->append('amenity_ids')->append('images')->toJson();
        $spotJson = new SpotResource($spot, true);

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
    public function update(Request $request, BaseSpot $spot)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required',
            'website' => 'required|url',
            'desc' => 'required',
            'price' => 'required|numeric|min:10',
            'address1' => 'required|string|max:255',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required',
            'owner_name' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'amenities' => 'array',
            'sleeps' => 'required|numeric',
            'baths' => 'required|numeric',
            'edit_token' => [
                'required',
                Rule::in($spot->editTokens->pluck('token'))
            ]
        ]);

        $spot->update($validated);
        if (array_key_exists('amenities', $validated) && count($validated['amenities'])) {
            $amenities = array_keys($validated['amenities']);
        } else {
            $amenities = [];
        }
        $spot->amenities()->sync($amenities);
        // Mail::to($spot->email)->send(new SpotSubmitted($spot->id));
        broadcast(new SpotWasUpdated($spot));

        return back();
    }

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
