<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $hidden = ['created_at', 'updated_at','id'];

    public function stations(){
        return $this->hasMany('App\Station');
    }


    protected $fillable =[
        'name'
    ];
}
