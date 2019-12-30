<?php

namespace Dingo\Api\Contract\Http;

use Illuminate\Http\Request as IlluminateRequest;

interface Request
{
    /**
     * Create a new Dingo request instance from an Illuminate request instance.
     *
     * @param IlluminateRequest $old
     *
     * @return \Dingo\Api\Http\Request
     */
    public function createFromIlluminate(IlluminateRequest $old);
}
