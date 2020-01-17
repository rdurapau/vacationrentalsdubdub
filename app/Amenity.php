<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    public $timestamps = false;

    public function spots()
    {
        return $this->belongsToMany('App\Spot', 'amenity_spot', 'amenity_id', 'spot_id');
    }

    /**
     * Get the amenity's absolute icon URL
     *
     * @param  string  $value
     * @return string
     */
    public function getIconUrlAttribute()
    {
        // if (isset($this['icon'])) {
        //     if (substr($this['avatar'],0,4) == 'http') {
        //         return $this['avatar'];
        //     } else {
        //         return (Storage::disk()->exists($this['avatar'])) ? url(Storage::disk()->url($this['avatar'])) : url('/img/user-default.png');
        //     }
        // } else {
        //     return '/img/user-default.png';
        // }
    }
}
