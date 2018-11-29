<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ZanController extends Controller
{
	public function __construct(){
		$this->middleware('auth',[
			'only'=>['make']
		]);
	}
    public function make(Request $request){
    	$type=$request->query('type');
    	$id=$request->query('id');
    	$class='App\Models\\'.ucfirst($type);
    	$model=$class::find($id);
    	//dd($model);
		//dd(auth()->id());
		$zan=$model->zan->where('user_id',auth()->id())->first();
		//dd($zan);
		if($zan){
			$zan->delete();
		}else{
			//dd($model->zan->all());
			$model->zan()->create(['user_id'=>auth()->id()]);
		}
		if($request->ajax()){
			$ajaxModel=$class::find($id);
			return ['code'=>1,'message'=>'','num'=>$ajaxModel->zan->count()];
		}
		return back();
	}
}
