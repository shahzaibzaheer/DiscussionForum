<?php

namespace App\Http\Middleware;

use Closure;

class OnlyAdmin
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
        if(Auth()->user() != null){
            if(Auth()->user()->isAdmin){
                return $next($request);
            }else{
                return response("Only Admin are allowed",401);
            }

        }else{
            return response("Guest are not allowed",401);
        }
    }
}
