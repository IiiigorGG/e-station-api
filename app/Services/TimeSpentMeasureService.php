<?php


namespace App\Services;


use App\Position;
use App\Services\Interfaces\MeasureServiceInterface;
use Illuminate\Support\Facades\Http;

class TimeSpentMeasureService implements MeasureServiceInterface
{
    public $value;

    public function setValue($userPosition,$stationPosition)
    {
        $responce = Http::get('https://maps.googleapis.com/maps/api/directions/json?origin='.Position::encodePosition($userPosition).'&destination='.Position::encodePosition($stationPosition).'&key=AIzaSyAbTYkZWcZK7Qimj2jjLvCrE4lVHT2JNTo');
        if($responce['status']!="OK"){
            return INF;
        }
        $this->value =  $responce['routes'][0]['legs'][0]['duration']['value'];
    }
}
