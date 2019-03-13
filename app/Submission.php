<?php

namespace App;

use App\Traits\Spotty;
use App\Traits\Moderatable;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends BaseSpot
{
    // use SoftDeletes, HasMediaTrait, Moderatable, Spotty;

    protected $table = 'spots';

    // protected $fillable = [
    //     'email',
    //     'name',
    //     'phone',
    //     'website',
    //     'desc',
    //     'price',
    //     'address1',
    //     'city',
    //     'state',
    //     'postal_code',
    //     'owner_name',
    //     'lat',
    //     'lng'
    // ];

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
