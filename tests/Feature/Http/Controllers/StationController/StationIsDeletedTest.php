<?php

namespace Tests\Feature\Http\Controllers\StationController;

use App\City;
use App\Position;
use App\Repositories\EloquentStationRepository;
use App\Station;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Mockery;
use Tests\TestCase;

class stationIsDeletedTest extends TestCase
{
    use RefreshDatabase;

    public function testStationIsDeleted()
    {
        $this->withoutMiddleware();
        $city = factory(City::class)->create(['name'=>'Odesa']);
        $position = factory(Position::class)->make([
            'latitude'=>34.2,
            'longitude'=>34.2
        ]);
        factory(Station::class)->create(['city_id'=>$city])->position()->save($position);

        $this->instance(EloquentStationRepository::class, Mockery::mock(EloquentStationRepository::class, function ($mock) {
            $mock->shouldReceive('deleteAndCheckCity')->once();
        }));

        $response = $this->delete('stations/1');

    }
}
