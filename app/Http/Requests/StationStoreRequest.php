<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationFailedException;
use App\Rules\StationDoesntExist;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class StationStoreRequest extends BaseRequest
{



    public function rules()
    {
        return [
            'city' => ['required','string'],
            'position.latitude' => ['required','between:-90.00,90.00'],
            'position.longitude' => ['required','between:-180.00,180.00'],
            'position' => [new StationDoesntExist]
        ];
    }

    public function filters()
    {
        return [
            'city' => 'trim|lowercase'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw (new ValidationFailedException($validator->getMessageBag()->first()));
    }
}
