<?php

namespace Tests\Feature\Rules;

use App\Rules\StationDoesntExist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class StationDoesntExistRuleTest extends TestCase
{
    use RefreshDatabase;


    public function testStationDoesntExistRulePasses()
    {
        $this->withoutMiddleware();
        $rule = new StationDoesntExist();
        $this->assertTrue($rule->passes('test',[
            'latitude' => 34.2,
            'longitude' => 37.4
        ]));
    }

    public function testStationDoesntExistRuleFails()
    {
        $this->withoutMiddleware();
        $this->postJson('/stations', [
            'city' => 'Odesa',
            'position'=>[
                'latitude' => 34.2,
                'longitude' => 37.4
            ]
        ]);
        $rule = new StationDoesntExist();
        $this->assertFalse($rule->passes('test', [
            'latitude' => 34.2,
            'longitude' => 37.4
        ]));
    }
}
