<?php

namespace Dingo\Api\Contract\Debug;

use Exception;
use Illuminate\Http\Response;

interface ExceptionHandler
{
    /**
     * Handle an exception.
     *
     * @param Exception $exception
     *
     * @return Response
     */
    public function handle(Exception $exception);
}
