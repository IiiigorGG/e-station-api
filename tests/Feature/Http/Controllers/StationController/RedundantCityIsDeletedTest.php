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
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class RedundantCityIsDeletedTest extends TestCase
{
    use RefreshDatabase;

    public function testRedundantCityIsDeleted()
    {
        $city = factory(City::class)->create(['name'=>'Odesa']);
        factory(Station::class)->create(['city_id'=>$city])->position()->save(factory(Position::class)->make());

        $this->instance(EloquentCityRepository::class, Mockery::mock(EloquentCityRepository::class, function ($mock) {
            $mock->shouldReceive('delete')->once();
        }));

        $response = $this->delete('stations/1');

    }
}
