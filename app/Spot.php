<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $fillable = [
        'email',
        'name',
        'phone',
        'website',
        'address1',
        'desc',
        'price',
        'address1',
        'city',
        'state',
        'zipcode',
        'owner_name'
    ];
}
