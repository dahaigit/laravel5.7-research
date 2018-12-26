<?php

namespace App\Http\Middleware;

use Closure;

class SchoolAfter
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
        $response = $next($request);
        echo '我是后置中间件';
        return $response;
    }

    public function terminate($request, $response)
    {
        echo "发送浏览器前我起作用";
    }
}
