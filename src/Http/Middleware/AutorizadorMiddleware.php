<?php

namespace Inadores\Autorizador\Http\Middleware;

use App\Models\Permiso;
use Closure;
use Illuminate\Http\Request;
use Inadores\Autorizador\Controladores;

class AutorizadorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Controladores::validar($request))
        {
            return $next($request);
        }
        return response()->json(['message' => 'no esta autorizado'], 401);
    }
}