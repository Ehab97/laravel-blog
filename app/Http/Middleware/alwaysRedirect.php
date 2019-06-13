<?php

namespace App\Http\Middleware;

use Closure;

class alwaysRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $request->path()=='about' ? redirect('/') :  $next($request);

       // return $next($request);
    }
}
