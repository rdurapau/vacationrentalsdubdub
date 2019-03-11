<?php

namespace App\Http\Controllers;

use App\Spot;
use App\BookingRequest;
use App\Mail\Booking\NewBookingRequest;
use App\Mail\Booking\BookingRequestConfirm;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingRequestController extends Controller
{
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
    public function create(Spot $spot)
    {
        return view('requests.create', compact('spot'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Spot $spot)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|confirmed|email',
            'dates' => 'required'
        ]);

        $bookingRequest = BookingRequest::make($validated);
        $spot->bookingRequests()->save($bookingRequest);

        Mail::to($spot->email)->send(new NewBookingRequest($bookingRequest));
        Mail::to($bookingRequest->email)->send(new BookingRequestConfirm($bookingRequest));
        // broadcast(new SpotWasSubmitted($spot));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookingRequest  $bookingRequest
     * @return \Illuminate\Http\Response
     */
    public function show(BookingRequest $bookingRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookingRequest  $bookingRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingRequest $bookingRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookingRequest  $bookingRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingRequest $bookingRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookingRequest  $bookingRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingRequest $bookingRequest)
    {
        //
    }
}
