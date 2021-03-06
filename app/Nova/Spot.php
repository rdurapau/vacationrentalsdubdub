<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsToMany;

use SweetSpot\BelongsToManyChecks\BelongsToManyChecks;
use SweetSpot\MapLocation\MapLocation;
use SweetSpot\EditUrl\EditUrl;
// use Fourstacks\NovaCheckboxes\Checkboxes;
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
    public static $title = 'address1';

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string
     */
    public function subtitle()
    {
        return "Owner: {$this->owner_name}";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'address1',
        'city',
        'state',
        'owner_name'
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
            Text::make('Spot Name', 'name')
                ->sortable()
                ->hideFromIndex()
                ->rules('required','max:100'),
            Trix::make('Description', 'desc')
                ->alwaysShow()
                ->rules('required'),
            Currency::make('Price')
                ->hideFromIndex()
                ->rules('required','integer','min:1'),
            Text::make('Link', 'view_url')
                ->withMeta(['extraAttributes' => [
                    'readonly' => true,
                ]])
                ->onlyOnDetail(),
            EditUrl::make('Edit Url')
                ->onlyOnDetail(),
            DateTime::make('Approved', 'moderated_at')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->format('YYYY-MM-DD @ HH:mm')
                ->sortable(),

            new Panel('Accomodations', $this->accomodationsFields()),

            new Panel('Owner Contact Information', $this->contactFields()),

            new Panel('Location Information', $this->addressFields()),

            new Panel('Photos', $this->photoFields()),

            HasMany::make('Booking Requests', 'bookingRequests')->hideFromIndex(),
        ];
    }

    protected function accomodationsFields()
    {
        return [
            Number::make('Sleeps')
                ->hideFromIndex()
                ->rules('required', 'integer'),
            Number::make('Beds')
                ->hideFromIndex()
                ->rules('required', 'integer'),
            Number::make('Baths')
                ->hideFromIndex()
                ->rules('required', 'integer'),
            BelongsToManyChecks::make('Amenities')
                ->populateWith(\App\Amenity::all())
                ->groupBy('type')
                ->selected($this->amenities->pluck('id')->toArray())
                ->hideFromIndex(),
        ];
    }

    protected function contactFields()
    {
        return [
            Text::make('Owner Name')
                ->hideFromIndex()
                ->rules('required', 'max:70'),
            Text::make('Website')
                ->hideFromIndex(),
                // ->rules('required'),
            Text::make('Email')
                ->hideFromIndex()
                ->rules('required','email'),
            Text::make('Phone Number', 'phone')
                ->hideFromIndex()
                ->rules('required')
        ];
    }

    protected function addressFields()
    {
        return [
            MapLocation::make('Location')
                ->lat($this->lat)
                ->lng($this->lng)
                // ->help(
                //     'Drag the map to change the location'
                // )
                ->hideFromIndex(),
            Text::make('Address', 'address1')
                ->sortable()
                ->rules('required')
                ->hideWhenCreating(),
            Text::make('City')
                ->sortable()
                ->rules('required')
                ->hideWhenCreating(),
            Text::make('State')
                ->sortable()
                ->rules('required')
                ->hideWhenCreating(),
            Text::make('Postal Code')
                ->hideFromIndex()
                ->rules('required')
                ->hideWhenCreating()
            // Number::make('Latitude', 'lat')->onlyOnForms(),
            // Number::make('Longitude', 'lng')->onlyOnForms()
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
        return [
            new Lenses\MostRequestedSpots,
        ];
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

    public static function svgIcon()
    {
        return '<svg class="sidebar-icon icon-location" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="var(--sidebar-icon)" d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" /></svg>';
    }

}
