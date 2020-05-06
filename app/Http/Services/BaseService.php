<?php

namespace App\Http\Services;
use Illuminate\Database\Eloquent\Model as Model;
use App\Models\Questions;
class BaseService {
    public $modelName = '\App\Models\\';
    public $banner;
    public $article;
    public $category;

    public function __get($class){
        $name = strtolower($class);
        if($this->$name && $this->$name instanceof Model){
            return $this->$name;
        }
        $obj = app()->make($this->modelName.$class);
        $this->$name = $obj;
        return $obj;
    }
    public function success($msg=0,$code=0,$data=[]){
        return [
            'code'=>$code,
            'message'=>$msg,
            'data'=>$data
        ];
    }
    
    public function error($msg=0,$code=10001,$data=[]){
        return [
            'code'=>$code,
            'message'=>$msg,
            'data'=>$data
        ];
    }

    /** 
     * 
     */
    protected function trimData(Array $data){
       return array_map(function($val){
            $type = gettype($val);
            switch($type){
                case 'string':
                    return trim($val);
                break;
                case 'array':
                    return json_encode($val,true);
                break;
                case 'boolean':
                    return $val===true?1:0;
                break;
                case 'integer':
                    return intval($val);
                break;
                case 'double':
                    return $val;
                break;
                default:
                    return null;

            }
        },$data);
    }
}
