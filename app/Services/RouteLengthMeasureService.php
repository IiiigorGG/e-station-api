<?php


namespace App\Services;


use App\HelpModels\Distance;
use App\HelpModels\Duration;
use App\Position;
use App\Services\Interfaces\MeasureServiceInterface;
use Illuminate\Support\Facades\Http;
use PHPUnit\Util\Json;
use Ramsey\Uuid\Type\Integer;

class RouteLengthMeasureService implements MeasureServiceInterface
{
    public $value;

    public function setValue($userPosition,$stationPosition){
        $responce = Http::get('https://maps.googleapis.com/maps/api/directions/json?origin='.Position::encodePosition($stationPosition).'&destination='.Position::encodePosition($userPosition).'&key=AIzaSyAbTYkZWcZK7Qimj2jjLvCrE4lVHT2JNTo');
        if($responce['status']!="OK"){
            return INF;
        }
        $this->value =  $responce['routes'][0]['legs'][0]['distance']['value'];
    }


    private function deg2rad(float $deg) {
        return $deg * (M_PI/180);
    }

}


