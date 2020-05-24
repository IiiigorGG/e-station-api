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

class cityIsNotDuplicatedTest extends TestCase
{
    use RefreshDatabase;

    public function testCityIsNotDuplicated()
    {
        $this->withoutMiddleware();
        $city = factory(City::class)->create(['name'=>'odesa']);
        $position = factory(Position::class)->make([
            'latitude'=>34.2,
            'longitude'=>34.2
        ]);
        factory(Station::class)->create(['city_id'=>$city])->position()->save($position);

        $response = $this->postJson('/stations', [
            'position'=>[
                'latitude' => 34.2,
                'longitude' => 37.4
            ],
            'city' => 'Odesa'
        ]);

      $this->assertDatabaseCount('cities',1);

    }
}
