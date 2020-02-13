<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\ApiController;
use Date;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\JsonResponse;

class Ping extends ApiController
{
    use Helpers;

    /**
     * Responds with a status for heath check.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return $this->response->array([
            'status' => 'ok',
            'timestamp' => Date::now(),
        ]);
    }
}
