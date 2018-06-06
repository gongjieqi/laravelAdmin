<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
class JWTCustomerAuth extends BaseMiddleware
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
        try{
            $this->authenticate($request);
        }catch (HttpException $exception){
            return response($exception->getMessage(),403,$exception->getHeaders());
        }
        return $next($request);
    }
}
