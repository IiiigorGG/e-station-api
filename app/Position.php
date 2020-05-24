<?php

namespace App;

use App\Services\DistanceService;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{

    protected $hidden = ['created_at', 'updated_at','id','station_id'];

    protected $fillable =[
        'latitude',
        'longitude'
    ];

    public static function parsePosition(string $latLon){
        return  new Position([
            'latitude'=>(float) substr($latLon,0,stripos($latLon,',')),
            'longitude'=>(float) substr($latLon,stripos($latLon,',')+1,strlen($latLon)-stripos($latLon,','))
        ]);
    }

    public static function encodePosition($position){
        return  $position->latitude . ',' . $position->longitude;
    }


}
