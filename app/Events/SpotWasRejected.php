<?php

namespace App\Events;

use App\BaseSpot;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SpotWasRejected
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $spot;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($spotId)
    {
        $this->spot = BaseSpot::find($spotId);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
