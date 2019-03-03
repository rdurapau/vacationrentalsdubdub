<?php 
namespace App\Traits;

use App\ModerationStatus;
use App\Events\SpotWasRejected;
use App\Events\SpotWasApproved;

trait Moderatable
{

    public function approve($message = NULL)
    {
        $this->moderation_status = ModerationStatus::APPROVED;
        $this->moderated_by = (auth()->check()) ? auth()->user()->id : NULL;
        $this->moderated_at = now();
        $this->save();

        // TODO: Send the optional message

        broadcast(new SpotWasApproved($this));
    }

    public function reject($message = NULL)
    {
        $this->moderation_status = ModerationStatus::REJECTED;
        $this->moderated_by = (auth()->check()) ? auth()->user()->id : NULL;
        $this->moderated_at = now();
        $this->save();

        // TODO: Send the optional message

        broadcast(new SpotWasRejected($this));
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