<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class CheckUserConfirmedEmail
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
        if (! $request->user()->confirmed()){ 
            return redirect()->route('request-confirm-email', $request->user());
        }
        return $next($request);
    }
}
