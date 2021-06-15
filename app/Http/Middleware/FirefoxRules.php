<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FirefoxRules
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!str_contains($request->headers->get('user-agent'), 'Firefox'))
            abort(403, 'Solo se puede usar Firefox jeje');
        return $next($request);
    }
}
