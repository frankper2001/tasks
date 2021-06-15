<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
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
        $response = $next($request);

        if($request->query('edad')<18)
            abort(403, 'Acceso denegado, debes ser mayor de edad para acceder a este contenido.');
            // if($user->edad <18) ...
        return $response;
    }
}
