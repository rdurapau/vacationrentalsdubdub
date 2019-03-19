<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Resource::withoutWrapping();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Added to get Heroku working
        Schema::defaultStringLength(191);


        // Relation::morphMap([
        //     'spots' => 'App\BaseSpot'
        // ]);
    }
}
