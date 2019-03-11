<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'dates',
        'spot_id'
    ];

    public $timestamps = false;
    protected $dates = [
        'created_at'
    ];

    public function spot()
    {
        return $this->belongsTo('App\Spot');
    }
}
