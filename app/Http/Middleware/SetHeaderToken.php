<?php

namespace App\Http\Middleware;

use Closure;

class SetHeaderToken
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
        $request->headers->set('Authorization', 'Bearer ' . $request->query('token',null));
        return $next($request);
    }
}
