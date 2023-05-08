<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Role
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
        // if(Auth::check() && auth()->user()->isBan == 0)
        // {
        //     return $next($request);
        // }
        // else
        // {
        //     return redirect()->back();
        // } 
        if(Auth::check() && Auth::user()->status)
        {
            $banned = Auth::user()->status == 1;
            Auth::logout();

            return redirect()->route('login');
        }
        return $next($request);
    }
}
