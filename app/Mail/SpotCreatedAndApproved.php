<?php

namespace App\Mail;

use App\BaseSpot;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SpotCreatedAndApproved extends Mailable
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
        return $this->subject('Your spot has been added to Sweet Spot')
            ->markdown('emails.spots.created-and-approved');
    }
}
