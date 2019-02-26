<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Trix;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;

use Illuminate\Http\Request;

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
            Text::make('Name')->sortable()->hideFromIndex(),
            Trix::make('Description', 'desc')->hideFromIndex(),
            Currency::make('Price')->sortable(),
            new Panel('Owner Contact Information', $this->contactFields()),
            new Panel('Address Information', $this->addressFields()),
            new Panel('Photos', $this->photoFields())
        ];
    }

    protected function contactFields()
    {
        return [
            Text::make('Owner Name'),
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
            Text::make('Postal Code')->hideFromIndex()
        ];
    }

    protected function photoFields()
    {
        return [
            Images::make('Photos','default')
                // ->conversion('medium-size') // conversion used to display the "original" image
                // ->conversionOnView('thumb') // conversion used on the model's view
                // ->thumbnail('thumb') // conversion used to display the image on the model's index page
                ->multiple() // enable upload of multiple images - also ordering
                ->fullSize() // full size column
                // ->rules('required', 'size:3') // validation rules for the collection of images
                // validation rules for the collection of images
                ->singleImageRules('dimensions:min_width=100')
                // ->thumbnail('thumb')
                // ->customPropertiesFields([
                //     Markdown::make('Description')
                // ])
                ->hideFromIndex()
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
