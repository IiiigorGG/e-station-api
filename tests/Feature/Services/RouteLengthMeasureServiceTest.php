<?php

namespace Tests\Feature\Services;

use App\Position;
use App\Services\DirectDistanceMeasureService;
use App\Services\RouteLengthMeasureService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class RouteLengthMeasureServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testValidRouteLengthValueIsSet()
    {
        $key = new RouteLengthMeasureService();
        $key->setValue(new Position(['latitude'=>54.2, 'longitude'=>34.2]),new Position(['latitude'=>55.2, 'longitude'=>35.2]));
        $this->assertTrue($key->value>0);
        $this->assertTrue(is_int($key->value));
    }
}
