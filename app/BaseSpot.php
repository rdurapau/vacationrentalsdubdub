<?php

namespace App;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Image\Manipulations;

use App\Traits\Moderatable;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;

class BaseSpot extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, Moderatable;  

    protected $morphClass = 'spot';

    protected $table = 'spots';

    protected $fillable = [
        'name',
        'desc',

        'email',
        'phone',
        'website',

        
        'address1',
        'city',
        'state',
        'postal_code',
        'lat',
        'lng',
        
        'sleeps',
        'baths',
        'beds',
        'sqft',
    ];

    protected $dates = [
        'moderated_at'
    ];


    public function getMorphClass()
    {
        return 'App\BaseSpot';
    }


    // ######                                                    
    // #     # ###### #        ##   ##### #  ####  #    #  ####  
    // #     # #      #       #  #    #   # #    # ##   # #      
    // ######  #####  #      #    #   #   # #    # # #  #  ####  
    // #   #   #      #      ######   #   # #    # #  # #      # 
    // #    #  #      #      #    #   #   # #    # #   ## #    # 
    // #     # ###### ###### #    #   #   #  ####  #    #  ####                                                                
    public function coverPhoto()
    {
        return url($this->getFirstMediaUrl());
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->crop(
                Manipulations::CROP_CENTER,
                300,
                300
            );

        $this->addMediaConversion('banner')
            ->crop(
                Manipulations::CROP_CENTER,
                800,
                320
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

    public function getAddressLine2Attribute()
    {
        return "{$this->city}, {$this->state} {$this->postal_code}";
    }

    public function getEditUrlAttribute()
    {
        return route('spots.edit', ['spots' => $this, 'editToken' => $this->editToken]);
    }

    public function getViewUrlAttribute()
    {
        return url('?spot='.$this->id);
    }

    public function getImagesAttribute()
    {
        return $this->getMedia()->map(function($media) {
            return $media->getFullUrl();
        });
    }

    public function getCoverPhotoAttribute()
    {
        return $this->getFirstMediaUrl() ? url($this->getFirstMediaUrl()) : NULL;
    }

    public function getCoverPhotoBannerAttribute()
    {
        $media = $this->getFirstMedia();
        return ($media && $media->hasGeneratedConversion('banner') && $media->getUrl('banner')) ? url($media->getUrl('banner')) : $this->cover_photo;
    }

    public function getOtherPhotosAttribute()
    {
        $allMedia = $this->getMedia();
        return ($allMedia->count() > 1)
            ? $allMedia->slice(1)->map(function($m){return $m->getFullUrl();})->toArray()
            : NULL;;
    }
}
