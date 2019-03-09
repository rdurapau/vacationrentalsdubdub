<?php

namespace App\Providers;

use App\Nova\Metrics\PendingSubmissions;
use App\Nova\Metrics\NewSubmissions;
use App\Nova\Metrics\NewSubmissionsPerDay;

use SweetSpot\PendingSubmissions\PendingSubmissions as PendingSubmissionsCard;

use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            // Two-thirds of the content area...
            (new PendingSubmissionsCard)->width('1/3')->showButton(true),
            
            // Two-thirds of the content area...
            (new PendingSubmissions)->width('1/3'),
            
            // Two-thirds of the content area...
            (new NewSubmissions)->width('1/3'),
    
            // Full width...
            (new NewSubmissionsPerDay)->width('2/3'),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
