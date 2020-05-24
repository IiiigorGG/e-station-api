<?php


namespace App\Repositories\Interfaces;


interface CityRepositoryInterface
{

    public function getOrCreate($name);

    public function delete($city);

    public function getCityStation($cityName);
}
