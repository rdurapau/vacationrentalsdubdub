<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Boolean;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class Spot extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Spot';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'address1',
        'city',
        'state',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Boolean::make('Visible', 'is_approved'),
            Text::make('Name')->sortable(),
            Trix::make('Description', 'desc')->hideFromIndex(),
            Currency::make('Price')->sortable(),
            new Panel('Owner Contact Information', $this->contactFields()),
            new Panel('Address Information', $this->addressFields())
        ];
    }

    protected function contactFields()
    {
        return [
            Text::make('Owner Name')->hideFromIndex(),
            Text::make('Website')->hideFromIndex(),
            Text::make('Email')->hideFromIndex(),
            Text::make('Phone Number', 'phone')->hideFromIndex()
        ];
    }

    protected function addressFields()
    {
        return [
            Place::make('Address', 'address1')->sortable(),
            Text::make('City')->sortable(),
            Text::make('State')->sortable(),
            Text::make('Postal Code', 'zipcode')->hideFromIndex()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
