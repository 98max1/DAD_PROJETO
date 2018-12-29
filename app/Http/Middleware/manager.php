<?php

namespace App\Http\Middleware;

use Closure;

class manager
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
        if (\Auth::guard('api')->user()&&\Auth::guard('api')->user()->isManager()) {
            return $next($request);
        }
        return response()->json("Unauthorized",401);
    }
}
