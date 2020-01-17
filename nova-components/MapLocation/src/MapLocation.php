<?php

namespace SweetSpot\MapLocation;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class MapLocation extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'map-location';

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->withMeta(['mapboxKey' => env('MIX_MAPBOX_APP_KEY')]);
    }

    public function lat($lat)
    {
        return $this->withMeta(['lat' => $lat]);
    }

    public function lng($lng)
    {
        return $this->withMeta(['lng' => $lng]);
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(NovaRequest $request,
                                                $requestAttribute,
                                                $model,
                                                $attribute)
    {

        $keys = ['lat', 'lng', 'address1', 'city', 'state', 'postal_code'];

        foreach ($keys as $key) {
            if ($request->exists($key)) {
                $model[$key] = $request[$key];
            }
        }

        // if ($request->exists($requestAttribute)) {
        //     if ($request[$requestAttribute]) {
        //         $ids = explode(',',$request[$requestAttribute]);
        //     } else {
        //         $ids = [];
        //     }

        //     if ($model->exists) {
        //         $model->$attribute()->sync($ids);
        //     } else {
        //         $model->setSelectedAmenities($ids); // This is managed in the saving event on BaseSpot
        //     }

        //     unset($request[$requestAttribute]);
        // }
    }

}
