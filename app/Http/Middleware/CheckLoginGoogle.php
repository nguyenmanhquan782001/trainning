<?php

namespace App\Http\Middleware;

use Closure;
//use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class CheckLoginGoogle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      $user = Auth::user();
        if ($user && $user->password == null){
            return  redirect()->route("forgot");
        }
        return $next($request);
    }
}
