<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function __construct(){
		$this->middleware('guest',[
			'only'=>['register','store','login','loginForm','passwordReset','passwordResetForm']
		]);
	}

	//注册页面
    public function register(){
    	return view('user.register');
	}

	//提交注册信息
	public function store(RegisterRequest $request){
		$data=$request->all();
		$data['password']=bcrypt($data['password']);
		User::create($data);
		return redirect()->route('login')->with('success','注册成功');

	}

	//登录页面
	public function login(Request $request){

		//dd($request->query('from'));
    	return view('user.login');
	}

	//提交登录信息
	public function loginForm(Request $request){
    	//dd($request->rem);
		//dd($request->from);
		$this->validate($request,[
			'email'=>'email',
			'password'=>'required|min:3',
		],[
			'email.email'=>'请输入正确邮箱',
			'password.required'=>'密码不正确',
			'password.min'=>'密码不正确',
		]);
		$res=$request->only('email','password');
		if(\Auth::attempt($res,$request->rem)){
			if($request->from){
				return redirect($request->from)->with('success','登录成功');
			}else{
				return redirect()->route('home')->with('success','登录成功');
			}

		}
		return redirect()->back()->with('danger','邮箱或者密码错误');

	}

	//退出登录
	public function logout(){
    	\Auth::logout();
    	return redirect()->route('home')->with('success','退出成功');
	}

	//重置密码
	public function passwordReset(){
    	return view('user.password_reset');
	}

	//重置密码提交
	public function passwordResetForm(PasswordResetRequest $request){
    	//dd($request->all());
		//dd($request->email);
		$user=User::where('email',$request->email)->first();
		if($user){
			$user->password=bcrypt($request->password);
			$user->save();
			return redirect()->route('login')->with('success','重置密码成功');
		}
		return redirect()->back()->with('danger','邮箱错误');
	}
}
