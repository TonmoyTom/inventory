<?php

namespace App\Http\Middleware;

use Closure;

class AuthLock
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
        $max = 0.1*60;

        if(!session()->has('last_request') || $max > (time() - session('last_request') )){
            session()->put('last_request',time());
        }

        if($max < (time() - session('last_request') )){
            session()->put('locked', 1);
            return redirect('/locked');
        }
        
        
        return $next($request);
    }
}
