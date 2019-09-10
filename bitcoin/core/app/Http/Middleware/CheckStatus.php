<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class CheckStatus
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
        if (Auth::check())
              {
                  if(Auth()->user()->tfver == '1' && Auth()->user()->status == '0')
                  {
                       return $next($request);
                  }
                  else
                  {
                       return redirect()->route('authorization');
                  }
              }
    }
}
