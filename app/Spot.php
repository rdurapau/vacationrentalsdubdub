<?php

namespace App;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Image\Manipulations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spot extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

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

        static::addGlobalScope('approved', function (Builder $builder) {
            $builder->where('moderation_status', ModerationStatus::APPROVED);
        });
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
             ->crop(
                Manipulations::CROP_CENTER,
                300,
                300
             );
    }
}
