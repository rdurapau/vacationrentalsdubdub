<?php

namespace App\Http\Controllers;

use App\BaseSpot;
use App\EditToken;
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

        return view('spots.edit', compact('spot', 'editToken'));
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
