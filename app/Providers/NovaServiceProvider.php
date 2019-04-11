<?php

namespace App\Providers;

use App\Nova\Metrics\PendingSubmissions;
use App\Nova\Metrics\NewBookingRequests;
use App\Nova\Metrics\BookingRequestsPerDay;
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
            return true;
            // return in_array($user->email, [
                //
            // ]);
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
            (new PendingSubmissionsCard)->width('1/3')->showButton(true),
            (new NewSubmissions)->width('1/3'),
            (new NewSubmissionsPerDay)->width('full'),
            (new BookingRequestsPerDay)->width('full'),
            (new NewBookingRequests)->width('1/3'),
            
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

    public static function svgIcon()
    {
        return '<svg class="sidebar-icon icon-location" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="var(--sidebar-icon)" d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" /></svg>';
    }
}
