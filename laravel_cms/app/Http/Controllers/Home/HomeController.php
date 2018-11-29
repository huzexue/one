<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{
    public function index(){
    	//dd(Activity::all());
		$actives = Activity::latest()->paginate(5);
		return view('home.index',compact('actives'));
	}
	//搜索
	public function search(Request $request){
    	$wd=$request->query('wd');
    	if(!$wd){
    		return redirect()->back()->with('danger','请输入内容');
		}
		$articles=Article::search($wd)->paginate(10);
		return view('home.search',compact('articles'));
	}
}
