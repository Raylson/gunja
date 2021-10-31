<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class AuthenticateSuperAdminUser
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
        // dd(Session::has('user_login'));
        if (!Session::has('user_login')){
            return redirect('/admin/login');
        }

        if(auth()->user()->user_type == 'admin')
            return redirect('/examiners/list');

        return $next($request);
    }
}
