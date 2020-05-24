<?php

namespace Tests\Feature\Http\Controllers\StationController;

use App\Repositories\EloquentCityRepository;
use App\Repositories\EloquentStationRepository;
use App\Station;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class stationIsCreatedTest extends TestCase
{
    use RefreshDatabase;

    public function testStationIsCreated()
    {
        $this->withoutMiddleware();
        $this->instance(EloquentStationRepository::class, Mockery::mock(EloquentStationRepository::class, function ($mock) {
            $mock->shouldReceive('saveWithRelations')->once();
        }));
        $this->instance(EloquentCityRepository::class, Mockery::mock(EloquentCityRepository::class, function ($mock) {
            $mock->shouldReceive('getOrCreate')->once();
        }));

        $response = $this->postJson('/stations', [
            'city' => 'Odesa',
            'position'=>[
                'latitude' => 34.2,
                'longitude' => 37.4
            ]
        ]);

    }
}
