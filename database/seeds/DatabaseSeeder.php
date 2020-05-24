<?php

use App\Position;
use App\Station;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('cities')->truncate();
        DB::table('stations')->truncate();
        DB::table('positions')->truncate();
//        factory(App\Station::class,3)->create()->each(function ($station){
//            $station->position()->save(factory(App\Position::class)->make());
//        });
        factory(Station::class,1)->create()->each(function ($station){
            $station ->position()->save(factory(Position::class)->make(['latitude'=>59.12, 'longitude'=>39.24]));
        });
        factory(Station::class,1)->create()->each(function ($station){
            $station ->position()->save(factory(Position::class)->make(['latitude'=>57.12, 'longitude'=>37.24]));
        });
        factory(Station::class,1)->create()->each(function ($station){
            $station ->position()->save(factory(Position::class)->make(['latitude'=>54.2, 'longitude'=>34.2]));
        });

    }
}

