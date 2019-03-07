<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditToken extends Model
{
    public $timestamps = false;

    public $fillable = [
        'token',
        'expires_at'
    ];

    public function getRouteKeyName()
    {
        return 'token';
    }

    public function spot()
    {
        return $this->belongsTo('App\Spot');
    }
}
