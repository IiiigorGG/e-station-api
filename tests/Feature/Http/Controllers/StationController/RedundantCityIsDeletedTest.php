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


 /*  I created and authenticated user in this particular
     2 tests because when disabling middleware, station
     is not deleted. I dont now why it happens.*/

    public function testRedundantCityIsDeleted()
    {
        //$this->withoutMiddleware();

        Artisan::call('passport:install');
        $this->postJson('/auth/register', [
            'name' => 'igor',
            'email' => 'example@example.com',
            'password' => 'password',
            'password_confirmation'=>'password'
        ]);

        $response = $this->postJson('/auth/login', [
            'email' => 'example@example.com',
            'password' => 'password'
        ]);

        $city = factory(City::class)->create(['name'=>'Odesa']);
        factory(Station::class)->create(['city_id'=>$city])->position()->save(factory(Position::class)->make());

        $this->instance(EloquentCityRepository::class, Mockery::mock(EloquentCityRepository::class, function ($mock) {
            $mock->shouldReceive('delete')->once();
        }));

        $response = $this->delete('stations/1?token=' . $response->json('token'));

    }
}
