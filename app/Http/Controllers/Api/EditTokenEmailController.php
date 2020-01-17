<?php

namespace App\Http\Controllers\Api;

use App\BaseSpot;
use Illuminate\Http\Request;

use App\Http\Resources\GeoSpot as GeoSpotResource;
use App\Http\Resources\GeoSpotCollection;
use App\Http\Resources\Spot as SpotResource;
use App\Http\Resources\SpotCollection;


class EditTokenEmailController extends ApiController
{
    /** 
     * Resend the edit_url via email to the spot owner
     * 
     * @param  Spot
     * @return @void
     */
    public function create(Request $request, BaseSpot $spot)
    {
        $spot->resendEditUrl();
        
        return $this->respondNoContent();
    }

}