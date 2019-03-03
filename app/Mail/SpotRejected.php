<?php

namespace App\Mail;

use App\Spot;

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
        $this->spot = Spot::withoutGlobalScope('approved')->find($spotId);
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.spots.rejected');
    }
}
