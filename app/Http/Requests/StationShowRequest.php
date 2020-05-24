<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StationShowRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'city'=>['string'],
            'status'=>[Rule::in(['open', 'closed'])]
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
