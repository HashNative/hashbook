<?php

namespace Illuminate\Contracts\Redis;

use Illuminate\Redis\Connections\Connection;

interface Factory
{
    /**
     * Get a Redis connection by name.
     *
     * @param  string  $name
     * @return Connection
     */
    public function connection($name = null);
}
