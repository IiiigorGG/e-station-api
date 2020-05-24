<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\StationShowRequest;
use App\Http\Requests\StationStoreRequest;
use App\Position;
use App\Repositories\EloquentCityRepository;
use App\Repositories\EloquentPositionRepository;
use App\Repositories\EloquentStationRepository;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Repositories\Interfaces\StationRepositoryInterface;
use App\Station;
use Illuminate\Http\Request;
use App\Http\Resources\Station as StationResource;
use phpDocumentor\Reflection\Types\This;
use PhpParser\Comment;

class StationController extends Controller
{

    protected $station;
    protected $city;
    protected $position;

    public function __construct(StationRepositoryInterface $station,CityRepositoryInterface $city,PositionRepositoryInterface $position)
    {
        $this->station = $station;
        $this->city = $city;
        $this->position = $position;
    }

    public function store(StationStoreRequest $request)
    {
        error_log('here');
        $city =$this->city->getOrCreate($request->input('city'));
        $station = $this->station->saveWithRelations($city,$request->input('position'));

        return response()->json([
            'station' => new StationResource($this->station->find($station->id))
        ],201);
    }


    public function show(StationShowRequest $request)
    {
        $status = $request->query('status', null);
        $city = $request->query('city', null);

        return response()->json([
            'stations'=>StationResource::collection($this->station->showRequested($city,$status))
        ],200);
    }


    public function showClosest(Request $request)
    {
        $requestPosition = $this->position->parsePosition($request->query('position'));
        $measure = $request->query('measure','direct_distance');

        $station = $this->station->getClosest($measure,$requestPosition);

        return response()->json([
            'duration' => $station->duration,
            'distance' => $station->distance,
            'station'=>new StationResource($station)
        ],200);
    }

    public function update(Request $request,Station $station)
    {
        $status = $request->input('status',$station->status);
        $cityName = $request->input('city',$station->city);
        $position = $request->input('position',$station->position);

        $this->station->updateCity($station,$this->city->getOrCreate($cityName));
        $this->station->updateStatus($station,$status);
        $this->station->updatePosition($station,$position);

        return response('',204);
    }


    public function delete(Station $station)
    {
        error_log('step1');
        $this->station->deleteAndCheckCity($station);

        return response('',204);
    }
}
