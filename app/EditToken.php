<?php

namespace App;

use App\Mail\SpotEditUrl;

use Illuminate\Support\Facades\Mail;
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
        return $this->belongsTo('App\BaseSpot', 'spot_id');
    }

    public function resendEmail()
    {
        Mail::to($this->spot->email)
            ->send(new SpotEditUrl($this));
    }

    public function getUrlAttribute()
    {
        return route('spots.edit', ['spots' => $this->spot, 'editToken' => $this]);
    }
}
