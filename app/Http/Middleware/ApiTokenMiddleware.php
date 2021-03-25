<?php

namespace App\Http\Middleware;

use App\Exceptions\APIException;
use Closure;

class ApiTokenMiddleware
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
        $testToken = 'ada63e98fe50eccb55036d88eda4b2c3709f53c2b65bc0335797067e9a2a5d8b';
        if ($request->header('Authenticate') != $testToken)
        {
            throw new APIException('驗證錯誤', 500);
        }
        return $next($request);
    }
}
