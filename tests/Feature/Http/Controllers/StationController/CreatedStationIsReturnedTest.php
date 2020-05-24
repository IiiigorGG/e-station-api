<?php

namespace Tests\Feature\Http\Controllers\StationController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreatedStationIsReturnedTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatedStationIsReturned()
    {
        $response = $this->postJson('/stations', [
            'position'=>[
                'latitude' => 34.2,
                'longitude' => 37.4
            ],
            'city' => 'Odesa'
        ]);

        $response->assertExactJson([
            'station' =>[
                'position'=>[
                    'latitude' => '34.2',
                    'longitude' => '37.4'
                ],
                'city' => ['name'=>'odesa'],
                'status'=>'closed',
                'id'=>1
            ]
        ]);
    }
}
