<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Service\Index;
use Illuminate\Support\Facades\Mail;
use App\Common\ErrorCode as ErrorCode;

class StarkController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    public function stark(){
        $data = 'hi stark';

        return $this->resStatus([
            'code'=>ErrorCode::OK,
            'message'=>'hello stark111',
            'data'=>$data
          ]);
    }

    public function shudong(){
        return $this->resStatus([
            'code'=>ErrorCode::OK,
            'message'=>'hello stark111'
          ]);
    }
}
