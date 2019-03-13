<?php

namespace App;

use App\Mail\SpotEditUrl;

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

    public function resendEmail()
    {
        Mail::to($this->spot->email)->send(new SpotEditUrl($this));
    }

    public function getUrlAttribute()
    {
        return route('editTokens.edit', ['spots' => $this->spot, 'editToken' => $this]);
    }
}
