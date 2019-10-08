<?php

namespace App\Http\Middleware;

use Closure;

class Permision
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permision)
    {
        if (Auth()->user()->role->hasPermission($permision)) return $next($request);

        return back()->with('msg-warning','Acceso no autorizado');

        
    }
}
