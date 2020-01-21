<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfWizardCompleted
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
        // Not in wizard
        if (!starts_with($request->getPathInfo(), '/wizard')) {
            return $next($request);
        }

        // Wizard not completed
        if (!setting('general.wizard', 0)) {
            return $next($request);
        }

        // Wizard completed, redirect to home
        redirect()->intended('/')->send();
    }
}
