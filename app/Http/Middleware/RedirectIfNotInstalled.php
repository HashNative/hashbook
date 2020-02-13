<?php

namespace App\Http\Middleware;

use Closure;
use File;
use Illuminate\Http\Request;

class RedirectIfNotInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if .env file exists
        if (File::exists(base_path('.env'))) {
            return $next($request);
        }

        // Already in the wizard
        if (starts_with($request->getPathInfo(), '/install')) {
            return $next($request);
        }

        // Not installed, redirect to installation wizard
        redirect('install/requirements')->send();
    }
}
