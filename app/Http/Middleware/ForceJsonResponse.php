<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonResponse
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
        // $request->headers->set('Accept', 'application/json');
        // return $next($request);
        
        $request->headers->set('Accept', 'application/json');

        $response = $next($request);

        // to append all the permission of the users in each API request
        // if(auth()->check())
        // {
        //     $original = $response->getOriginalContent();
        //     if(!isset($original['logout']))
        //     {
        //         $allPerm = auth()->user()->getAllPermissions();
        //         $allPerm = implode($allPerm->pluck('name')->toArray(), '|');
        //         $original['user_perms'] = $allPerm;

        //         if(auth()->user()->hasRole('super-admin'))
        //             $original['super_admin'] = true;

        //         if($response->status() != '422' && $response->status() != '500')    // This is to handle the invalid message details.
        //             $response->setContent($original);
        //     }
        // }

        return $response;
    }
}
