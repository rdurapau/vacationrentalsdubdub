<?php

namespace App;

use App\EditToken;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Image\Manipulations;

use App\Traits\Moderatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spot extends BaseSpot
{
    // use SoftDeletes, HasMediaTrait, Moderatable;

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

    // protected $dates = [
    //     'moderated_at'
    // ];

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

}
