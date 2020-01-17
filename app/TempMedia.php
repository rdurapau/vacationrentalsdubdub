<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Image\Manipulations;

use Carbon\Carbon;

class TempMedia extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['expires_at','filename'];
    public $timestamps = false;
    protected $dates = ['expires_at'];

    // Where photos are stored, relative to /storage/app/
    public $storagePath = 'temp/uploads';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function($photo) {
            
            $photo->expires_at = Carbon::now()->addMinutes(30);

        });

        // static::deleting(function($photo) {
            
        //     Storage::delete($photo->filePath());

        // });
    }

    /**
     * Scope a query to only include expired uploads.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }

    /** 
     * Get the full relative path to the file for this TempMedia
     * 
     * @param @void
     * @return json
     */
    // public function filePath() {

    //     return $this->storagePath .'/'. $this->filename;

    // }


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
}
