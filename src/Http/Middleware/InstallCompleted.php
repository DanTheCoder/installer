<?php

namespace DanTheCoder\Installer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InstallCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Return to the home page if the install process was completed
        if (config('installer.completed')) {
            return redirect('/');
        }

        return $next($request);
    }
}
