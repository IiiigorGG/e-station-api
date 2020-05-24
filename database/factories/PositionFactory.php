<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Position;
use Faker\Generator as Faker;

$factory->define(Position::class, function (Faker $faker) {
    return [
        'latitude'=>$faker->randomFloat(0,0,100),
        'longitude'=>$faker->randomFloat(0,0,100),
    ];
});
