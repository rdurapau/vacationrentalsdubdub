<?php

namespace App\Mail;

use App\BaseSpot;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SpotSubmitted extends Mailable
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
        $this->spot = BaseSpot::find($spotId);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Sweet Spot has been submitted for review')
            ->markdown('emails.spots.submitted');
    }
}
