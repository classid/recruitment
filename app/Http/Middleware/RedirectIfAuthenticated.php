<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param mixed ...$inputGuards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$inputGuards)
    {
        $guards = empty($inputGuards) ? [null] : $inputGuards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(config('fortify.home'));
            }
        }

        return $next($request);
    }
}
