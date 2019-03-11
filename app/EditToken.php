<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditToken extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'token',
        'expires_at'
    ];

    protected $dates = [
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