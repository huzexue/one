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
Route::get('/','HomeController@index')->name('home');

//注册
Route::get('/register','UserController@register')->name('register');
Route::post('/register','UserController@store')->name('register');
Route::get('/login','UserController@login')->name('login');
//验证码
Route::any('/code/send','Util\CodeController@send')->name('code.send');