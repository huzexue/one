<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function edit($name){

		hh_config('uploasasdad.size');
		$config=Config::firstOrNew(
			['name'=>$name]
		);
		//dd($config);
    	return view('admin.config.edit_'.$name,compact('name','config'));
	}

	public function update($name,Request $request){
    	$res=Config::updateOrCreate(
    		['name'=>$name],
			['data'=>$request->all()]
		);
		//hd_edit_env($request->all());
    	//dd($res);
		return back()->with('success','配置项设置成功');
	}
}
