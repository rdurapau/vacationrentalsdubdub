<?php

namespace App\Mail;

use App\Spot;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SpotApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $spot;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($spotId)
    {
        $this->spot = Spot::find($spotId);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.spots.approved');
    }
}