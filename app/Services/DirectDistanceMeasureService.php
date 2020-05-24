<?php


namespace App\Services;


use App\Services\Interfaces\MeasureServiceInterface;

class DirectDistanceMeasureService implements MeasureServiceInterface
{
    public $value;

    public function setValue($userPosition,$stationPosition){
        $earthR = 6371;
        $dLatitude = deg2rad($stationPosition->latitude-$userPosition->latitude);
        $dLongitude = deg2rad($stationPosition->longitude-$userPosition->longitude);
        $a = sin($dLatitude/2) * sin($dLatitude/2) + cos(deg2rad($userPosition->latitude))
            * cos(deg2rad($stationPosition->latitude)) * sin($dLongitude/2) * sin($dLongitude/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $d = $earthR * $c;
        $this->value = $d;
    }
}
