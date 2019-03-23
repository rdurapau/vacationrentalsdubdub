<?php

namespace SweetSpot\MapLocation;

use Laravel\Nova\Fields\Field;

class MapLocation extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'map-location';

    public function env()
    {
        // dump(env('MIX_MAPBOX_APP_KEY'));
        return $this->withMeta(['mapboxKey' => env('MIX_MAPBOX_APP_KEY')]);
    }    
}
