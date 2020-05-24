<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ValidationFailedException extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    public function render($request)
    {
        return response()->json([
            'message'=>$this->message
        ],400);
    }
}
