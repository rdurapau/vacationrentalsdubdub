<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'url',
        'caption'
    ];

    public function photos()
    {
        return $this->belongsTo('App\Spot');
    }
}
