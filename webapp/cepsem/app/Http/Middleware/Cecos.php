<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cecos
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

            if(auth()->user()->rols_id == 2){
                return $next($request);
            }
            else{
                return route('login');
            }

    }
}
