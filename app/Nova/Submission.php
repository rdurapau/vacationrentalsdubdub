<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\DateTime;
use SweetSpot\ModerateSpot\ModerateSpot;
use App\Nova\Filters\ModerationFilter;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;

use SweetSpot\PendingSubmissions\PendingSubmissions as PendingSubmissionsCard;

use App\ModerationStatus;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class Submission extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Submission';

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
            // ModerateSpot::make(),
            Text::make('Name')->sortable()->hideFromIndex(),
            Trix::make('Description', 'desc')->hideFromIndex(),
            Currency::make('Price')->sortable(),
            new Panel('Owner Contact Information', $this->contactFields()),
            new Panel('Address Information', $this->addressFields()),
            new Panel('Photos', $this->photoFields()),
            DateTime::make('Submitted', 'created_at')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->format('YYYY-MM-DD @ HH:mm')
                ->sortable(),
            Text::make('Edit Url', function () {
                return $this->edit_url;
            })->onlyOnDetail()
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
        return [
            (new PendingSubmissionsCard)->showButton(false),
            new Metrics\NewSubmissions,
            new Metrics\NewSubmissionsPerDay,
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new ModerationFilter
        ];
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
        return [
            new Actions\ApproveSubmission,
            new Actions\RejectSubmission
        ];
    }
    
    public static function countBadge()
    {
        // return 1;
        // return self::count;
        // return $this->count;
        return \App\Submission::count();
    }

    public static function svgIcon()
    {
        return '<svg class="sidebar-icon icon-notification" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="var(--sidebar-icon)" d="M15 19a3 3 0 0 1-6 0H4a1 1 0 0 1 0-2h1v-6a7 7 0 0 1 4.02-6.34 3 3 0 0 1 5.96 0A7 7 0 0 1 19 11v6h1a1 1 0 0 1 0 2h-5zm-4 0a1 1 0 0 0 2 0h-2zm0-12.9A5 5 0 0 0 7 11v6h10v-6a5 5 0 0 0-4-4.9V5a1 1 0 0 0-2 0v1.1z"/></svg>';
    }
}
