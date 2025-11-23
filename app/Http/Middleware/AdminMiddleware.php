<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Verifica que el usuario sea administrador
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->esAdmin()) {
            abort(403, 'No tienes permiso para acceder a esta sección');
        }

        return $next($request);
    }
}
