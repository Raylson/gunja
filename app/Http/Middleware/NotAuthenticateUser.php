<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotAuthenticateUser
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
        if (\Session::has('user_login')){
            if(session('user_login')['user_type'] == 'superadmin')
                return redirect('/admin/dashboard');
            else if(session('user_login')['user_type'] == 'admin')
                return redirect('/examiners/list');
            else
                return redirect('/');
        }
        return $next($request);
    }
}
