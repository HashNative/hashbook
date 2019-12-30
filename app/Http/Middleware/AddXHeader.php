<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddXHeader
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
        $response = $next($request);

        // Check if we should add header
        if (method_exists($response, 'header')) {
            $response->header('X-Akaunting', 'Free Accounting Software');
        }

        return $response;
    }
}