<?php

namespace App\Mail;

use App\EditToken;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SpotEditUrl extends Mailable
{
    use Queueable, SerializesModels;

    public $spot,$token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EditToken $token)
    {
        $this->token = $token;
        $this->spot = $this->token->spot;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Here's your Sweet Spot edit URL")
            ->markdown('emails.spots.edit-url');
    }
}
