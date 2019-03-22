<?php

namespace App\Http\Controllers\Api;

use App\BaseSpot;
use Illuminate\Http\Request;

use App\Http\Resources\GeoSpot as GeoSpotResource;
use App\Http\Resources\GeoSpotCollection;
use App\Http\Resources\Spot as SpotResource;
use App\Http\Resources\SpotCollection;


class SpotModerationController extends ApiController
{
    /** 
     * Resend the edit_url via email to the spot owner
     * 
     * @param  BaseSpot
     * @return @void
     */
    public function update(Request $request, BaseSpot $spot)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'message' => 'string|nullable'
        ]);

        $message = (array_key_exists('message', $validated)) ? $validated['message'] : NULL;
        
        $spot->moderate($validated['status'],$message);

        $spot->resendEditUrl();
        
        return $this->respondNoContent();
    }

}