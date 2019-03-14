<?php

namespace App\Http\Controllers\Api;

use App\Spot;
use Illuminate\Http\Request;

use App\Http\Resources\GeoSpot as GeoSpotResource;
use App\Http\Resources\GeoSpotCollection;
use App\Http\Resources\Spot as SpotResource;
use App\Http\Resources\SpotCollection;


class SpotController extends ApiController
{
    public function index(Request $request)
    {
        $spots = Spot::all();

        if ($this->wantsGeoJson($request)) {
            return response()
                ->json(new GeoSpotCollection($spots))
                ->header('Content-Type', 'application/geo+json');
        } else {
            return response()
                ->json(new SpotCollection($spots))
                ->header('Content-Type', 'application/json');
        }
    }

    public function show(Request $request, Spot $spot)
    {
        if ($this->wantsGeoJson($request)) {
            return response()
                ->json(new GeoSpotResource($spot))
                ->header('Content-Type', 'application/geo+json');
        } else {
            return response()
                ->json(new SpotResource($spot))
                ->header('Content-Type', 'application/json');
        }
    }

}