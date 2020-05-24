<?php


namespace App\Repositories;


use App\HelpModels\Distance;
use App\Position;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Repositories\Interfaces\StationRepositoryInterface;
use App\Services\DirectDistanceMeasureService;
use App\Services\RouteLengthMeasureService;
use App\Services\TimeSpentMeasureService;
use App\Station;
use Illuminate\Database\Eloquent\Collection;

class EloquentStationRepository implements StationRepositoryInterface
{

    protected $station;
    protected $city;
    protected $position;

    public function __construct(Station $station,CityRepositoryInterface $city,PositionRepositoryInterface $position)
    {
        $this->station = $station;
        $this->city = $city;
        $this->position = $position;
    }

    public function all()
    {
        return $this->station->all();
    }

    public function find($id)
    {
        return $this->station->find($id);
    }


    public function saveWithRelations($city, $position)
    {
        return $this->station->create(['city_id'=>$city->id])->position()->save($this->position->make([
            'latitude'=>$position['latitude'],
            'longitude'=>$position['longitude']
        ]));
    }

    public function showRequested($cityName, $status)
    {
        if($cityName!=null){
            $stations =$this->city->getCityStations($cityName);
        }
        else{
            return $this->station->all();
        }

        if($status!=null){
            $stations = $stations->where('status',$status);
        }

        return $stations;
    }

    public function updateCity($station,$city)
    {
        $station->city_id = $city->id;
        $station->save();
    }

    public function updateStatus($station,$status)
    {
        $station->status = $status;
        $station->save();
    }

    public function updatePosition($station,$position)
    {
        $station->position->update($position);
    }

    public function deleteAndCheckCity($station)
    {
        error_log('step2');

        $station->position->delete();
        $station->delete();


        if(count($station->city->stations)==0) {
            error_log('step3');

            $this->city->delete($station->city);
        }
    }

    public function getClosest($measure, $userPosition)
    {
        $stations = $this->station->all();
        $this->fillKeyValue($stations,$measure, $userPosition);
        $stations = $stations->sortBy('key.value');
        return $stations->first();
    }

    private function fillKeyValue($stations,$measure, $userPosition){
        foreach ($stations as $station){
            $station->key = $this->getMeasurer($measure);
            $station->key->setValue($userPosition,$station->position);
        }
    }

    private function getMeasurer($measure){
        switch ($measure){
            case 'direct_distance':
                return new DirectDistanceMeasureService();
                break;
            case 'route_length':
                return new RouteLengthMeasureService();
                break;
            case 'time_spent':
                return new TimeSpentMeasureService();
                break;
        }
    }

}
