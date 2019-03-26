<?php

namespace App\Services;

use App\Http\Exceptions\ManualException;
use Illuminate\Http\JsonResponse;

class GeneralService
{

    public function __construct()
    {

    }

    public function getSuccessResponse($data)
    {
        $response['code'] = JsonResponse::HTTP_OK;

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return $response;
    }

}