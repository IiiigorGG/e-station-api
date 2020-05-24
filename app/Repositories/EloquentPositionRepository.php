<?php


namespace App\Repositories;


use App\City;
use App\Position;
use App\Repositories\Interfaces\PositionRepositoryInterface;

class EloquentPositionRepository implements PositionRepositoryInterface
{
    protected $position;

    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    public  function parsePosition($latLon){
        return  new Position([
            'latitude'=>(float) substr($latLon,0,stripos($latLon,',')),
            'longitude'=>(float) substr($latLon,stripos($latLon,',')+1,strlen($latLon)-stripos($latLon,','))
        ]);
    }

    public function make($inputs)
    {
        return $this->position->make($inputs);
    }
}
