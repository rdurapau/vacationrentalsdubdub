<?php

namespace App\Mail\Booking;

use App\Spot;
use App\BookingRequest;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewBookingRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingRequest, $spot;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BookingRequest $bookingRequest)
    {
        $this->bookingRequest = $bookingRequest;
        $this->spot = $this->bookingRequest->spot;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.booking.new-request-to-owner');
    }
}
