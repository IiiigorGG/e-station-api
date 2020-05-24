<?php

namespace Tests\Feature\Services;

use App\Position;
use App\Services\DirectDistanceMeasureService;
use PHPUnit\Framework\TestCase;

class DirectDistanceMeasureServiceTest extends TestCase
{
    public function testValidDirectDistanceValueIsSet()
    {
        $key = new DirectDistanceMeasureService();
        $key->setValue(new Position(['latitude'=>54.2, 'longitude'=>34.2]),new Position(['latitude'=>55.2, 'longitude'=>35.2]));
        $this->assertTrue($key->value > 0);
        $this->assertTrue(is_float($key->value));
    }
}
