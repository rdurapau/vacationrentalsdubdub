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

class Spot extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, Moderatable;

    protected $fillable = [
        'email',
        'name',
        'phone',
        'website',
        'desc',
        'price',
        'address1',
        'city',
        'state',
        'postal_code',
        'owner_name',
        'lat',
        'lng'
    ];

    protected $dates = [
        'moderated_at'
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

        static::created(function($spot) {
            do {
                $token = str_random(30);
            } while (EditToken::where('token', $token)->count() > 0);
            $editToken = new EditToken([
                'token' => $token,
                'expires_at' => now()->addDays(7)
            ]);
            $editToken->spot()->associate($spot);
            $editToken->save();
        });
    }

    public function editToken()
    {
        return $this->hasOne('App\EditToken');
    }

    public function editTokens()
    {
        return $this->hasMany('App\EditToken');
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

    public function getFullAddressAttribute()
    {
        return "{$this->address1}, {$this->city}, {$this->state} {$this->postal_code}";
    }

    public function getEditUrlAttribute()
    {
        return route('editTokens.edit', ['spots' => $this, 'editToken' => $this->editToken]);
    }

}
