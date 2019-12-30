<?php

namespace Dingo\Api\Facade;

use Closure;
use Dingo\Api\Auth\Auth;
use Dingo\Api\Http\InternalRequest;
use Dingo\Api\Http\Response\Factory;
use Dingo\Api\Routing\Router;
use Dingo\Api\Transformer\Binding;
use Illuminate\Auth\GenericUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

class API extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'api.dispatcher';
    }

    /**
     * Bind an exception handler.
     *
     * @param callable $callback
     *
     * @return void
     */
    public static function error(callable $callback)
    {
        return static::$app['api.exception']->register($callback);
    }

    /**
     * Register a class transformer.
     *
     * @param string          $class
     * @param string|Closure $transformer
     *
     * @return Binding
     */
    public static function transform($class, $transformer)
    {
        return static::$app['api.transformer']->register($class, $transformer);
    }

    /**
     * Get the authenticator.
     *
     * @return Auth
     */
    public static function auth()
    {
        return static::$app['api.auth'];
    }

    /**
     * Get the authenticated user.
     *
     * @return GenericUser|Model
     */
    public static function user()
    {
        return static::$app['api.auth']->user();
    }

    /**
     * Determine if a request is internal.
     *
     * @return bool
     */
    public static function internal()
    {
        return static::$app['api.router']->getCurrentRequest() instanceof InternalRequest;
    }

    /**
     * Get the response factory to begin building a response.
     *
     * @return Factory
     */
    public static function response()
    {
        return static::$app['api.http.response'];
    }

    /**
     * Get the API router instance.
     *
     * @return Router
     */
    public static function router()
    {
        return static::$app['api.router'];
    }
}
