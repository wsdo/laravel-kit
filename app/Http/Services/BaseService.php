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
}
