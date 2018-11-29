<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectController extends Controller
{
	public function __construct(){
		$this->middleware('auth',[
			'only'=>['make']
		]);
	}
    public function make(Request $request){
		$type=$request->query('type');
		$id=$request->query('id');
		$class='App\Models\\'.$type;
		$model=$class::find($id);
		$collect=$model->collect->where('user_id',auth()->id())->first();
		if($collect){
			$collect->delete();
		}else{
			$model->collect()->create(['user_id'=>auth()->id()]);
		}
		return back();
	}

}
