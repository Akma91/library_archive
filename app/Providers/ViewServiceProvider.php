<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            'layout', 'App\Http\View\Composers\RecommendationViewComposer'
        );
 
        // Using Closure based composers...
        View::composer('dashboard', function ($view) {
            //
        });
    }
}
