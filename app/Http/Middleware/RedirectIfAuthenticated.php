<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        error_log($request->url());
        foreach ($guards as $guard) {
            error_log($guard);
            if ($guard == 'admin' && ($request->is('admin') || $request->is('admin/*')) &&  Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::ADMIN_HOME);
            }

            if ($request->is('admin') || $request->is('admin/*')) {
                continue;
            }

            if ($guard == null && Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        error_log("redirecting...");
        return $next($request);
    }
}
