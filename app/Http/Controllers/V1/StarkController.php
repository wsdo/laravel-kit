<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Service\Index;
use Illuminate\Support\Facades\Mail;
class StarkController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['create']]);
    // }


    public function stark(){
        $data = 'hi stark';

        return $this->resOk($data);
    }

    public function shudong(){
        return $this->resOk('Hello shudong!');
    }
}
