<?php

namespace App\Mail;

use App\BaseSpot;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SpotRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $spot;
    public $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($spotId, $reason = NULL)
    {
        $this->spot = BaseSpot::find($spotId);
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Sweet Spot has been rejected')
            ->markdown('emails.spots.rejected');
    }
}
