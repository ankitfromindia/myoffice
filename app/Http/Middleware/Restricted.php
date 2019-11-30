<?php

namespace App\Http\Middleware;

use Closure;

class Restricted
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
//        if(backpack_user()->hasAnyRole(['Tester', 'Developer']))
//        {
//            return redirect('/admin/dashboard');
//        }
        return $next($request);
    }
}
