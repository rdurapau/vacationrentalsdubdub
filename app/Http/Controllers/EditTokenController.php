<?php

namespace App\Http\Controllers;

use App\Amenity;
use App\BaseSpot;
use App\EditToken;

use App\Http\Resources\Spot as SpotResource;

use Illuminate\Http\Request;

class EditTokenController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Allows this controller to query for all spots (even non-approved)
        // $this->middleware('spots.all');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EditToken  $editToken
     * @return \Illuminate\Http\Response
     */
    public function show(EditToken $editToken)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
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
        return view('spots.edit-new', compact('spotJson', 'editToken','amenities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EditToken  $editToken
     * @return \Illuminate\Http\Response
     */
    public function editOld(BaseSpot $spot, EditToken $editToken)
    {
        if ($editToken->spot_id != $spot->id) {
            return false;
        }
        $amenities = Amenity::all();
        $selectedAmenities = $spot->amenities()->pluck('id');
        $amenities->each(function($a) use ($selectedAmenities) {
            // $a->selected = (in_array($a->id, $spot->amenity_ids));
            $a->selected = $selectedAmenities->contains($a->id);
        });
        // dd($amenities);
        return view('spots.edit', compact('spot', 'editToken','amenities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EditToken  $editToken
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EditToken $editToken)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EditToken  $editToken
     * @return \Illuminate\Http\Response
     */
    public function destroy(EditToken $editToken)
    {
        //
    }
}
