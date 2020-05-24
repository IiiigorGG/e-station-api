<?php


namespace App\Repositories;


use App\City;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Station;
use Illuminate\Database\Eloquent\Collection;

class EloquentCityRepository implements CityRepositoryInterface
{
    protected $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    public function getOrCreate($name)
    {
        if($this->city->where('name',$name)->exists()){
            $city = $this->city->where('name',$name)->first();
            return $city;
        }
        else{
            $city = $this->city->create(['name'=>$name]);
            return $city;
        }
    }

    public function delete($city)
    {
        $this->city->find($city->id)->delete();
    }

    public function getCityStations($cityName)
    {
        $city =  $this->city->where('name',$cityName)->first();

        if($city!=null){
            return $city->stations;
        }
        else{
            return new Collection();
        }
    }
}
