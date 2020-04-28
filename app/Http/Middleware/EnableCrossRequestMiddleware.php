<?php
/*
 * @Author: starkwang
 * @Contact me: https://shudong.wang/about
 * @Date: 2020-02-18 18:29:44
 * @LastEditors: starkwang
 * @LastEditTime: 2020-02-22 19:15:15
 * @Description: file content
 */

namespace App\Http\Middleware;

use Closure;

class EnableCrossRequestMiddleware
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
        // return $next($request);
        $response = $next($request);
        $origin = $request->server('HTTP_ORIGIN') ? $request->server('HTTP_ORIGIN') : '';
        $allow_origin = [
            'http://localhost:4000',
            'https://localhost:4000',
            'http://localhost:3400',
            'http://localhost:3800',
            'http://localhost:8000',
            'http://localhost:4100',
            'https://kb.kaikeba.com',
        ];
        if (in_array($origin, $allow_origin)) {
            $response->header('Access-Control-Allow-Origin', $origin);
            $response->header('Access-Control-Allow-Headers', 'Origin,x-requested-with,Content-Type, Cookie, X-CSRF-TOKEN, Accept, Authorization, X-XSRF-TOKEN');
            $response->header('Access-Control-Expose-Headers', 'Authorization, authenticated');
            $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
            $response->header('Access-Control-Allow-Credentials', 'true');
        }
        return $response;
    }
}
