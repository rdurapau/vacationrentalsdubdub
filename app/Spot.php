<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class Spot extends BaseSpot
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

        static::addGlobalScope('approved', function (Builder $builder) {
            $builder->where('moderation_status', ModerationStatus::APPROVED);
        });
    }



    public function media()
    {
        return $this->morphMany(config('medialibrary.media_model'), 'model');
    }

}
