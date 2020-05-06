<?php
namespace App\Http\Services;

use App\Http\Model\Account as Account;
use App\Http\Model\Users;
use App\Http\Service\BaseService;
use App\Http\Service\UsersService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Mockery\Exception;
use App\Common\ErrorCode as ErrorCode;

class CommonService {
    public $client;

    protected function createHttp(){
        if(!$this->client instanceof Client){
            $this->client = new Client();
        }
        return $this->client;
    }
    /**
     * post 请求
     * @param string url 请求地址
     * @param array or object data 请求参数
     * @return array or null or object
     */
    public function curlPost($url,$data){
        if(!$url){
            return $this->error('连接格式不正确',ErrorCode::INVALID_DATA);
        }
        $resp = $this->HttpRequest('post',$url,$data);
        return \GuzzleHttp\json_decode($resp->getBody()->__toString(), true);
    }

    /**
     * @params url 请求地址
     * @return array or object or null
     */
    public function curlGet($url){
        if(!$url){
            return $this->error('连接格式不正确',ErrorCode::INVALID_DATA);
        }
        return $this->HttpRequest('get',$url);
    }

    /**
     * @param string $method 请求方式
     * @param string $url 请求地址
     * @param array or object or null $data 请求参数
     * @return array or object o rnull
     */
    protected function HttpRequest($method,$url,$data=[]){
        try{
            return $this->createHttp()->request(
                $method,
                $url,
                [
                    'json'=>$data,
                    'headers'=>[
                        'Content_type'=>'application/json; charset=utf-8'
                    ]
                ]

            );
        }catch(Exception $error){
            return 'error';
        }
    }
}