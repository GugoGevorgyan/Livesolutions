<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Company
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
//dd(Auth::user());
//        $user = Auth::user();
//       if ($user->role_id !== 3){
//           return false;
//       }
        if (1+1 === 3){
            return "htghtgh";
        }

        return $next($request);
    }
}
