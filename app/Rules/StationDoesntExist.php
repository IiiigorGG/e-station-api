<?php

namespace App\Rules;

use App\Position;
use App\Station;
use Illuminate\Contracts\Validation\Rule;

class StationDoesntExist implements Rule
{

    public function passes($attribute, $value)
    {
        if(Position::where(['latitude'=>$value['latitude'],'longitude'=>$value['longitude']])->first()!=null)return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry, station bounded to this location already exists.';
    }
}
