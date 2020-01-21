<?php

namespace Illuminate\Support\Facades;

use Illuminate\Support\ServiceProvider;

/**
 * @method static string version()
 * @method static string basePath()
 * @method static string environment()
 * @method static bool isDownForMaintenance()
 * @method static void registerConfiguredProviders()
 * @method static ServiceProvider register(ServiceProvider|string $provider, array $options = [], bool $force = false)
 * @method static void registerDeferredProvider(string $provider, string $service = null)
 * @method static void boot()
 * @method static void booting(mixed $callback)
 * @method static void booted(mixed $callback)
 * @method static string getCachedServicesPath()
 *
 * @see \Illuminate\Foundation\Application
 */
class App extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'app';
    }
}
