<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //return $next($request);
        return $next($request);
        if (!Auth::check()) {
            return redirect()->route('login.show');
        }
        if (auth()->user()->Role == 2) {
            return $next($request);
        }
        return redirect()->route('index')->withErrors(['error' => 'Nincs hozzáférése az oldalhoz :(']);
    }
}
