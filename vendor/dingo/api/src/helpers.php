<?php


use Dingo\Api\Routing\UrlGenerator;

if (! function_exists('version')) {
    /**
     * Set the version to generate API URLs to.
     *
     * @param string $version
     *
     * @return UrlGenerator
     */
    function version($version)
    {
        return app('api.url')->version($version);
    }
}
