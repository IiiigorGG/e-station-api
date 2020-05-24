<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Waavi\Sanitizer\Laravel\SanitizesInput;

abstract class BaseRequest extends FormRequest
{
    use  SanitizesInput;

    public function validateResolved()
    {
        {
            $this->sanitize();
            parent::validateResolved();
        }
    }

    abstract public function rules();

    public function authorize(){
        return true;
    }

}
