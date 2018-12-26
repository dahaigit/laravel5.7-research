<?php

namespace App\Http\Middleware;

use Closure;

class School
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
        echo "我是前置中间件";
        return $next($request);
    }


}
