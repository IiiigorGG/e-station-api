<?php

namespace App;

use App\HelpModels\Distance;
use App\HelpModels\Duration;
use App\Services\RouteLengthMeasureService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public static $userPosition;

    protected $hidden = ['created_at', 'updated_at','city_id'];

    protected $with = ['city','position'];

    protected $fillable= [
        'city_id',
        'status'
    ];

    public $key;

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function position()
    {
        return $this->hasOne('App\Position');
    }


}
