<?php

namespace App\Http\Controllers\Member;

use App\Models\Article;
use App\Models\Collect;
use App\Models\Zan;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function __construct(){
		$this->middleware('auth',[
			'only'=>['edit','update','attention']
		]);
	}

    public function show(User $user)
    {
    	$articles=Article::latest()->where('user_id',$user->id)->paginate(10);

        return view('member.user.show',compact('user','articles'));
    }


    public function edit(User $user,Request $request)
    {
    	//dd($user->id);
		$this->authorize('isMine',$user);

		$type=$request->query('type');
        return view('member.user.edit_'.$type,compact('user','request'));
    }


    public function update(Request $request, User $user)
    {

    	$data=$request->all();
		$this->authorize('isMine',$user);
		$this->validate($request,[
			'password' =>'sometimes|required|min:3|confirmed',
			'name'=>'sometimes|required',
		],[
			'password.required'=>'请输入密码',
			'password.min'=>'密码不得小于3位',
			'password.confirmed'=>'两次密码不一致',
			'name.required'=>'请输入昵称'
		]);
		if($request->password){
			$data['password'] = bcrypt($data['password']);
		}
		//执行更新
		$user->update($data);
		return redirect()->route('home.article.index')->with('success','操作成功');
    }


    public function attention(User $user)
    {

		$user->fans()->toggle(auth()->user());

		return back();
    }

	public function fansList(User $user)
	{
		$fans=$user->fans()->paginate(6);
		//$a=$fans->contains(auth()->user());
		//dd($a);

		return view('member.fans.fanslist',compact('user','fans'));
	}

	public function attentionList(User $user){
    	$attentionlists=$user->following()->paginate(6);
		return view('member.fans.attentionlist',compact('user','attentionlists'));
	}
	//我的收藏
	public function collect(User $user,Request $request){
		$type=$request->query('type');
		$collects=$user->collect()->where('collect_type','App\Models\\'.ucfirst($type))->paginate(10);

		return view('member.user.collect',compact('user','collects'));
	}

	//我的点赞
	public function myZan(User $user,Request $request,Zan $zans){
		$type=$request->query('type');


		$zansData=$user->zan()->where('zan_type','App\Models\\'.ucfirst($type))->paginate(2);
		//dd($zansData);
		return view('member.user.my_zan_'.$type,compact('user','zans','zansData'));
	}
}
