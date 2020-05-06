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
    function resStatus($error)
    {
        $data = $error['data']??[];
        $code = $error['code']??10001;
        $message = $error['message']??'未知错误';
        return $this->json($data,$code,$message);
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
