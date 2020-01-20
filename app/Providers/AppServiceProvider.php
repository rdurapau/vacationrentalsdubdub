<?php

namespace App\Providers;

use Whitecube\NovaPage\Pages\Manager as NovaPagesManager;

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

        if(env('APP_ENV') === 'production') {
            \URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(NovaPagesManager $pages)
    {
        // Added to get Heroku working
        Schema::defaultStringLength(191);

        $pages->register('option', 'termsOfService', \App\Nova\Templates\TermsOfService::class);
        $pages->register('option', 'about', \App\Nova\Templates\About::class);


        // Relation::morphMap([
        //     'spots' => 'App\BaseSpot'
        // ]);
    }
}
