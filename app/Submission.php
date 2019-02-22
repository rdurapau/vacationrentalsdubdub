<?php

namespace App;

use App\ModerationStatus;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $table = 'spots';

    protected $fillable = [
        'email',
        'name',
        'phone',
        'website',
        'address1',
        'desc',
        'price',
        'address1',
        'city',
        'state',
        'postal_code',
        'owner_name'
    ];

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

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(400)
              ->height(400)
              ->sharpen(10);
    }

}
