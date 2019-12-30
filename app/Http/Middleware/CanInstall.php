<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanInstall
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
        // Check if app is installed
        if (env('APP_INSTALLED', false) == false) {
            return $next($request);
        }

        // Already installed, redirect to login
        redirect('auth/login')->send();
    }
}
