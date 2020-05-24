<?php

namespace Tests\Feature\Http\Controllers\StationController;

use App\City;
use App\Position;
use App\Repositories\EloquentCityRepository;
use App\Repositories\EloquentStationRepository;
use App\Station;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Mockery;
use Tests\TestCase;

class stationIsUpdatedTest extends TestCase
{
    use RefreshDatabase;

    public function testStationIsUpdated()
    {
        $city = factory(City::class)->create(['name'=>'Odesa']);
        $position = factory(Position::class)->make([
            'latitude'=>34.2,
            'longitude'=>34.2
        ]);
        factory(Station::class)->create(['city_id'=>$city])->position()->save($position);

        $this->instance(EloquentStationRepository::class, Mockery::mock(EloquentStationRepository::class, function ($mock) {
            $mock->shouldReceive('updateCity')->once();
            $mock->shouldReceive('updateStatus')->once();
            $mock->shouldReceive('updatePosition')->once();
        }));

        $response = $this->putJson('/stations/1', [
            'position'=>[
                'latitude'=>0.0,
                'longitude'=>0.0
            ],
            'status'=>'open',
            'city' => 'Lviv'
        ]);

    }
}
