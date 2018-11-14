<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

	//注册页面
    public function register(){
    	return view('user.register');
	}
	//提交注册信息
	public function store(UserRequest $request){
		$data=$request->all();
		$data['password']=bcrypt($data['password']);
		User::create($data);
		return redirect()->route('login')->with('success','注册成功');

	}
	//登录页面
	public function login(){

    	return view('user.login');

	}

}
