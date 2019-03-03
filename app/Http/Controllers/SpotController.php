<?php

namespace App\Http\Controllers;

use App\Spot;
use App\Mail\SpotSubmitted;
use App\Events\SpotWasSubmitted;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('spots.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('spots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|confirmed|email',
            'name' => 'required',
            'phone' => 'required',
            'website' => 'required|url',
            'desc' => 'required',
            'price' => 'required|numeric|min:10|max:1000',
            'address1' => 'required|string|max:255',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required',
            'owner_name' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);

        $spot = Spot::create($validated);

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
     * @return \Illuminate\Http\Response
     */
    public function edit(Spot $spot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spot $spot)
    {
        //
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
