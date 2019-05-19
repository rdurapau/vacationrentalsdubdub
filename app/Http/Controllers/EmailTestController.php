<?php

namespace App\Http\Controllers;

use App\Spot;
use App\BookingRequest;
use App\EditToken;

use Illuminate\Http\Request;

class EmailTestController extends Controller
{
    public function spotApproved()
    {
        $spot = Spot::first();
        return (new \App\Mail\SpotApproved($spot->id))->render();
    }

    public function spotRejected(Request $request)
    {
        $withReason = $request->input('r');
        $reason = ($withReason) ? 'Your spot does not meet our standards of quality. Please review our Terms of Service for more details' : NULL;

        $spot = Spot::first();
        return (new \App\Mail\SpotRejected($spot->id, $reason))->render();
    }

    public function spotSubmitted()
    {
        $spot = Spot::first();
        return (new \App\Mail\SpotSubmitted($spot->id))->render();
    }

    public function spotEditUrl()
    {
        $token = EditToken::first();
        return (new \App\Mail\SpotEditUrl($token))->render();
    }

    public function newRequest()
    {
        $bookingRequest = BookingRequest::first();
        return (new \App\Mail\Booking\NewBookingRequest($bookingRequest))->render();
    }

    public function newRequestConfirm()
    {
        $bookingRequest = BookingRequest::first();
        return (new \App\Mail\Booking\BookingRequestConfirm($bookingRequest))->render();
    }
    
}
