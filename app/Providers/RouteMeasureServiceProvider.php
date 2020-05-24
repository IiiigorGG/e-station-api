<?php

namespace App\Providers;

use App\Services\RouteLengthMeasureService;
use Illuminate\Support\ServiceProvider;

class RouteMeasureServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->singleton('RouteLengthMeasureService', function ($app) {
            return new RouteLengthMeasureService();
        });
    }

}
