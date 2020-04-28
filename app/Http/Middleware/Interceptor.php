<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Interceptor extends BaseMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|mixed
     * @throws JWTException
     */
    public function handle($request, Closure $next)
    {

//        return $next($request);
        // 使用 try 包裹，以捕捉 token 过期所抛出的 TokenExpiredException  异常
        try {
            // 检查此次请求中是否带有 token，如果没有则抛出异常。
            $this->checkForToken($request);
            // 检测用户的登录状态，如果正常则通过
            if ($this->auth->parseToken()->authenticate()) {
                return $next($request);
            }
            //throw new UnauthorizedHttpException('jwt-auth', '未登录');
            return response()->json([
                'code' => 4011,
                'data' => [],
                'message' => '未登录',
            ]);
        }catch (UnauthorizedHttpException $exception){
            //throw new UnauthorizedHttpException('jwt-auth', '未登录');
            return response()->json([
                'code' => 4012,
                'data' => [],
                'message' => '未登录',
            ]);
        }catch(TokenBlacklistedException $exception){

            //当用户退出之后，token就会被拉黑，就会返回TokenBlacklistedException
            //throw new UnauthorizedHttpException('jwt-auth', '未登录');
            return response()->json([
                'code' => 4013,
                'data' => [],
                'message' => '未登录',
            ]);
        }catch(TokenInvalidException $exception){
            return response()->json([
                    'code' => 4015,
                    'data' => [],
                    'message' => '登陆已过期,重新登陆',
                ]);
        } catch (TokenExpiredException $exception) {
            // 此处捕获到了 token 过期所抛出的 TokenExpiredException 异常，我们在这里需要做的是刷新该用户的 token 并将它添加到响应头中
            try {
                // 刷新用户的 token
                $token = $this->auth->refresh();
                // 使用一次性登录以保证此次请求的成功
                Auth::guard('api')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);
                // 在响应头中返回新的 token
                return $this->setAuthenticationHeader($next($request), $token);
            } catch (JWTException $exception) {
                // 如果捕获到此异常，即代表 refresh 也过期了，用户无法刷新令牌，需要重新登录。
            //    throw new UnauthorizedHttpException('jwt-auth', $exception->getMessage());
                return response()->json([
                    'code' => 4014,
                    'data' => [],
                    'message' => $exception->getMessage(),
                ]);
            }
        }
    }
}
