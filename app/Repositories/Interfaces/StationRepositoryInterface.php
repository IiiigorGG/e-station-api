<?php


namespace App\Repositories\Interfaces;


interface StationRepositoryInterface
{
    public function all();

    public function find($id);

    public function updateCity($station,$city);

    public function updateStatus($station,$city);

    public function updatePosition($station,$city);

    public function saveWithRelations($city,$position);

    public function deleteAndCheckCity($station);

    public function showRequested($city,$status);

    public function getClosest($measure,$userPosition);

}
