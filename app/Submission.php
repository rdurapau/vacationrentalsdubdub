<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

class Submission extends BaseSpot
{
    protected $table = 'spots';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('pending', function (Builder $builder) {
            $builder->where('moderation_status', ModerationStatus::PENDING);
        });

        // static::withoutGlobalScope('approved');
    }

    /**
     * Scope a query to only include rejected submissions
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRejected($query)
    {
        return $query
            ->withoutGlobalScope('pending')
            ->where('moderation_status', ModerationStatus::REJECTED);
    }

    /**
     * Scope a query to include pending and rejected submissions
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIncludeRejected($query)
    {
        return $query
            ->withoutGlobalScope('pending')
            ->whereIn('moderation_status',[
                ModerationStatus::PENDING,
                ModerationStatus::REJECTED
            ]);
    }
}
