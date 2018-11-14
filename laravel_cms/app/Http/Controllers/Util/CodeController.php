<?php

namespace App\Http\Controllers\Util;

use App\Notifications\RegisterNotify;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
    //发送验证码
	public function send(Request $request){
		$code=$this->random();
		$user=User::firstOrNew(['email'=>$request->username]);
		//dd($user);
		$user->notify(new RegisterNotify($code));
		//dd($user);
		session()->put('code',$code);
		return ['code' => 1, 'message' => '发送成功'];
	}
	//随机验证码
	public function random($len=4){
		$str='';
		for($a=0;$a<$len;$a++){
			$str.=mt_rand(0,9);
		}
		return $str;
	}
}
