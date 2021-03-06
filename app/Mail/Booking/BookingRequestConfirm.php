<?php

namespace App\Mail\Booking;

use App\Spot;
use App\BookingRequest;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingRequestConfirm extends Mailable
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
        return $this->subject('Sweet Spot: Your reservation request has been received!')
            ->markdown('emails.booking.new-request-to-sender');
    }
}
