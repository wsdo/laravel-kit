<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        /**
     * 公用的方法  返回json数据，进行信息的提示
     * @param array $data 返回数据
     * @param int $code
     * @param string $message 提示信息
     * @return JsonResponse
     */
    function resOk($data = array(), $code = 1, $message = '')
    {
        return $this->json($data,$code,$message);
    }

    /**
     * 公用的方法  返回json数据，进行信息的提示
     * @param array $data 返回数据
     * @param int $code
     * @param string $message 提示信息
     * @return JsonResponse
     */
    function resError($data = array(), $code = 0, $message = '未知错误')
    {
        return $this->json($data,$code);
    }

    public function json($data = array(), $code = 10, $message = '')
    {
        $result = [
            'code' => $code,
            'data' => $data,
            'message' => $message,
        ];
        return response()->json($result);
    }
}
