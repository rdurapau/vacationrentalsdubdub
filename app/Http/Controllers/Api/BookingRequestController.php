<?php
namespace App\Http\Controllers\Api;

use App\BookingRequest;
use App\Spot;
use App\Mail\Booking\NewBookingRequest;
use App\Mail\Booking\BookingRequestConfirm;

// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class BookingRequestController extends ApiController
{
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

        $this->setStatusCode(201);
        return $this->respond(['id'=>$bookingRequest->id]);
    }
}
