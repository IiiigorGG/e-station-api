<?php

namespace App\Providers;

use App\Repositories\EloquentCityRepository;
use App\Repositories\EloquentPositionRepository;
use App\Repositories\EloquentStationRepository;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Repositories\Interfaces\StationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind(
            StationRepositoryInterface::class,
            EloquentStationRepository::class
        );

        $this->app->bind(
            CityRepositoryInterface::class,
            EloquentCityRepository::class
        );

        $this->app->bind(
            PositionRepositoryInterface::class,
            EloquentPositionRepository::class
        );
    }

}
