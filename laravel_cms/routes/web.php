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
Route::any('/code/send','Util\CodeController@send')->name('code.send');

//后台
Route::group(['middleware'=>['admin.auth'],'prefix'=>'admin','namespace'=>'Admin','as'=>'admin.'],function(){
	Route::get('/index','IndexController@index')->name('index');
});
