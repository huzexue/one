<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//主页
Route::get('/','Home\HomeController@index')->name('home');
//Route::get('/home','Home\HomeController@index')->name('home');
Route::group(['prefix'=>'home','namespace'=>'Home','as'=>'home.'],function(){
	Route::get('/','HomeController@index')->name('index');
	Route::resource('article','ArticleController');
});
//会员中心
Route::group(['prefix'=>'member','namespace'=>'Member','as'=>'member.'],function(){

	Route::resource('/user','UserController');
});


//用户
//注册
Route::get('/register','UserController@register')->name('register');
Route::post('/register','UserController@store')->name('register');
//登录
Route::get('/login','UserController@login')->name('login');
Route::post('/login','UserController@loginForm')->name('login');
//退出登录
Route::get('/logout','UserController@logout')->name('logout');
//忘记密码
Route::get('/passwordReset','UserController@passwordReset')->name('passwordReset');
Route::post('/passwordReset','UserController@passwordResetForm')->name('passwordReset');

//工具类
Route::group(['prefix'=>'util','namespace'=>'Util','as'=>'util.'],function(){
	//发送验证码
	Route::any('/code/send','CodeController@send')->name('code.send');
	//上传
	Route::any('/upload','UploadController@uploader')->name('upload');
	Route::any('/filesLists','UploadController@filesLists')->name('filesLists');
});

//后台
Route::group(['middleware'=>['admin.auth'],'prefix'=>'admin','namespace'=>'Admin','as'=>'admin.'],function(){
	Route::get('/index','IndexController@index')->name('index');
	Route::resource('/category','CategoryController');
});

