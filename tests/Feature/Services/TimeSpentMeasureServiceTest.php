<?php

namespace Tests\Feature\Services;

use App\Position;
use App\Services\DirectDistanceMeasureService;
use App\Services\TimeSpentMeasureService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class TimeSpentMeasureServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testValidTimeSpentValueIsSet()
    {
        $key = new TimeSpentMeasureService();
        $key->setValue(new Position(['latitude'=>54.2, 'longitude'=>34.2]),new Position(['latitude'=>55.2, 'longitude'=>35.2]));
        $this->assertTrue($key->value > 0  && is_int($key->value));
    }
}
