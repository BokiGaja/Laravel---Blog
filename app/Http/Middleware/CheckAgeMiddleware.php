<?php

namespace App\Http\Middleware;

use Closure;

class CheckAgeMiddleware
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
        if ($request->age < 18)
        {
            session()->flash('message', 'You are not old enough');
            return redirect()->route('show-register');
        }
        return $next($request);
    }
}
