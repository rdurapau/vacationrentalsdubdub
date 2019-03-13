<?php

namespace App\Http\Controllers\Api;

use App\Spot;
use App\Http\Resources\SpotGeo as SpotGeoResource;
use App\Http\Resources\SpotGeoCollection;

class SpotController extends ApiController
{

    public function index()
    {
        return new SpotGeoCollection(Spot::all()); 
    }

    public function show(Spot $spot)
    {
        return new SpotGeoResource($spot);
    }

}