<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class VerifyEmail
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
        $response = $next($request);
        dd($request->all());
        $user = User::where('username', $request->username)->first();
        dd($user);
/*
        if ($user->status == 0) {
            return redirect()->route('forceLogout');
        }
*/
        return $response;
    }
}
