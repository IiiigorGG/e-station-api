<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Station;
use Faker\Generator as Faker;

$factory->define(Station::class, function (Faker $faker) {
    return [
        'status' => 'closed',
        'city_id'=> factory(\App\City::class)
    ];
});
