<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class AuthAdmin
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
        if (auth()->guard('admin')->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('非法用户！.', 401);
            } else {
                return redirect()->guest('admin/login');
            }
        }

        if(auth()->guard('admin')->user()->hasRole('admin')){
            return $next($request);
        }

        if(!auth()->guard('admin')->user()->can(Route::currentRouteName()) && Route::currentRouteName()!='admin.home') {
            return response('您没有权限执行当前操作', 401);
        }

        return $next($request);
    }
}
