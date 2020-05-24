<?php


namespace App\Repositories\Interfaces;


interface PositionRepositoryInterface
{
    public function parsePosition($latLon);

    public function make($inputs);
}
