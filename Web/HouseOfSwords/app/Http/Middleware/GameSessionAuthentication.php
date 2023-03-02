<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class GameSessionAuthentication
{
    private $notAuthorizedRoute = 'api/gameSessionAuthFail';
    private $apiLoginRoute = 'api/createGameSession';
    private $testRoute = 'api/test';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // ONLY CHECK API REQUESTS
        if (!str_starts_with($request->path(), 'api')){
            return $next($request);
        }

        // ONLY ALLOW REQUESTS WITH GAME SESSION TOKENS OR LOGIN REQUESTS
        $sessionToken = $request->query('gamesessiontoken', null);
        if (!$sessionToken &&
            $request->path() != $this->notAuthorizedRoute &&
            $request->path() != $this->apiLoginRoute &&
            $request->path() != $this->testRoute){
            return redirect($this->notAuthorizedRoute);
        }

        // VALIDATE SESSION TOKEN
        $userWithToken = User::all()->firstWhere('GameSessionToken', 'LIKE', $sessionToken);
        if (!$userWithToken){
            return redirect($this->notAuthorizedRoute);
        }

        return $next($request);
    }
}
