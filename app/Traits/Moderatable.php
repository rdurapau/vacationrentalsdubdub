<?php 
namespace App\Traits;

use App\ModerationStatus;
use App\Mail\SpotApproved;
use App\Mail\SpotRejected;
use App\Events\SpotWasRejected;
use App\Events\SpotWasApproved;

use Illuminate\Support\Facades\Mail;

trait Moderatable
{

    public function approve($message = NULL)
    {
        $this->moderation_status = ModerationStatus::APPROVED;
        $this->moderated_by = (auth()->check()) ? auth()->user()->id : NULL;
        $this->moderated_at = now();
        $this->save();

        // TODO: Break this out to a listener
        Mail::to($this->email)->send(new SpotApproved($this->id));

        broadcast(new SpotWasApproved($this->id));
    }

    public function reject($message = NULL)
    {
        $this->moderation_status = ModerationStatus::REJECTED;
        $this->moderated_by = (auth()->check()) ? auth()->user()->id : NULL;
        $this->moderated_at = now();
        $this->save();

        // TODO: Break this out to a listener
        Mail::to($this->email)->send(new SpotRejected($this->id, $message));

        broadcast(new SpotWasApproved($this->id));
    }

    public function moderationStatus()
    {
        return ModerationStatus::getFriendly($this->moderation_status);
    }

    public function isApproved()
    {
        return ($this->moderation_status == ModerationStatus::APPROVED);
    }

    public function isRejected()
    {
        return ($this->moderation_status == ModerationStatus::REJECTED);
    }

    public function isPending()
    {
        return ($this->moderation_status == ModerationStatus::PENDING);
    }

}