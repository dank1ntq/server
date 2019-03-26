<?php

namespace App\Http\Exceptions;

use Exception;
use Throwable;

use Illuminate\Http\JsonResponse;

class ManualException extends Exception
{

    public function __construct($message = "", $code = JsonResponse::HTTP_BAD_REQUEST, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}