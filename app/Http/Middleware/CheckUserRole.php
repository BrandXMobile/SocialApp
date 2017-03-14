<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserRole
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
        if($request->user() ===null){
            return response("Access permission denied",401);
        }

        //go to route try to access in web.php and find action middleware defined
        
        $actions=$request->route()->getAction();
        $roles= isset($actions['roles'])?  $actions['roles']:null;

        if($request->user()->hasAnyRole($roles) || !$roles){
             return $next($request);
        }

        return response("Access permission denied",401);
    }
}
