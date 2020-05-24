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

class ClosestStationIsShownTest extends TestCase
{
    use RefreshDatabase;


    public function testClosestIsShown()
    {
        $city1 = factory(City::class)->create(['name'=>'Lviv']);
        $city2 = factory(City::class)->create(['name'=>'Kyiv']);

        factory(Station::class,1)->create(['status'=>'open','city_id'=>$city1])->each(function ($station){
            $station ->position()->save(factory(Position::class)->make(['latitude'=>34.2, 'longitude'=>34.2]));
        });
        factory(Station::class,1)->create(['status'=>'closed','city_id'=>$city2])->each(function ($station){
            $station ->position()->save(factory(Position::class)->make(['latitude'=>34.2, 'longitude'=>34.2]));
        });

        $this->instance(EloquentStationRepository::class, Mockery::mock(EloquentStationRepository::class, function ($mock) {
            $mock->shouldReceive('getClosest')->once();
        }));

        $response = $this->get('stations/closest');
    }
}
