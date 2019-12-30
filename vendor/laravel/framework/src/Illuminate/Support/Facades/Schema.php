<?php

namespace Illuminate\Support\Facades;

use Closure;
use Illuminate\Database\Schema\Builder;

/**
 * @method static Builder create(string $table, Closure $callback)
 * @method static Builder drop(string $table)
 * @method static Builder dropIfExists(string $table)
 * @method static Builder table(string $table, Closure $callback)
 *
 * @see \Illuminate\Database\Schema\Builder
 */
class Schema extends Facade
{
    /**
     * Get a schema builder instance for a connection.
     *
     * @param  string  $name
     * @return Builder
     */
    public static function connection($name)
    {
        return static::$app['db']->connection($name)->getSchemaBuilder();
    }

    /**
     * Get a schema builder instance for the default connection.
     *
     * @return Builder
     */
    protected static function getFacadeAccessor()
    {
        return static::$app['db']->connection()->getSchemaBuilder();
    }
}
