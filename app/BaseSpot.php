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

class BaseSpot extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, Moderatable;

    protected $table = 'spots';

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

        // static::saving(function ($spot) {
        //     dump('hmm');
        //     dump($spot->selected_amenities);
        //     if ($spot->isDirty('selected_amenities')) {
        //         $spot->amenities()->sync($spot->selected_amenities);
        //         unset($spot->selected_amenities);
        //     }
        // });
    }

    // ######                                                    
    // #     # ###### #        ##   ##### #  ####  #    #  ####  
    // #     # #      #       #  #    #   # #    # ##   # #      
    // ######  #####  #      #    #   #   # #    # # #  #  ####  
    // #   #   #      #      ######   #   # #    # #  # #      # 
    // #    #  #      #      #    #   #   # #    # #   ## #    # 
    // #     # ###### ###### #    #   #   #  ####  #    #  ####                                                                
    public function amenities()
    {
        return $this->belongsToMany('App\Amenity', 'amenity_spot', 'spot_id', 'amenity_id');
    }
    
    public function bookingRequests()
    {
        return $this->hasMany('App\BookingRequest', 'spot_id');
    }
    
    public function editToken()
    {
        return $this->hasOne('App\EditToken', 'spot_id')
            ->orderByDesc('expires_at');
    }

    public function editTokens()
    {
        return $this->hasMany('App\EditToken', 'spot_id');
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

    //     #                                                            
    //    # #    ####   ####  ######  ####   ####   ####  #####   ####  
    //   #   #  #    # #    # #      #      #      #    # #    # #      
    //  #     # #      #      #####   ####   ####  #    # #    #  ####  
    //  ####### #      #      #           #      # #    # #####       # 
    //  #     # #    # #    # #      #    # #    # #    # #   #  #    # 
    //  #     #  ####   ####  ######  ####   ####   ####  #    #  ####                                                                 
    public function getFullAddressAttribute()
    {
        return "{$this->address1}, {$this->city}, {$this->state} {$this->postal_code}";
    }

    public function getEditUrlAttribute()
    {
        return route('editTokens.edit', ['spots' => $this, 'editToken' => $this->editToken]);
    }

    //  #     #                                          
    //  ##   ## ###### ##### #    #  ####  #####   ####  
    //  # # # # #        #   #    # #    # #    # #      
    //  #  #  # #####    #   ###### #    # #    #  ####  
    //  #     # #        #   #    # #    # #    #      # 
    //  #     # #        #   #    # #    # #    # #    # 
    //  #     # ######   #   #    #  ####  #####   ####                             
    public function resendEditUrl()
    {
        return $this->editToken->resendEmail();
    }

}
