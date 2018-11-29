<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Laravel\Scout\Searchable;
class Article extends Model
{
	###################全局动态；————————————————————————————————————
	use LogsActivity,Searchable;
	protected $fillable = ['title','content','id'];
	//记录$fillable所有的字段
	protected static $logFillable = true;
	//模型动作属性
	protected static $recordEvents = ['created','updated'];
	//自定义日志
	protected static $logName = 'article';
	###################全局动态；————————————————————————————————
    public function user(){
    	return $this->belongsTo(User::class);
	}

	public function category(){
    	return $this->belongsTo(Category::class);
	}
	//与赞模型进行多态关联
	public function zan(){
    	return $this->morphMany(Zan::class,'zan');
	}

	public function collect(){
    	return $this->morphMany(Collect::class,'collect');
	}

	//评论通知  通知 已读之后跳转链接
	public function getLink($param){
		return route('home.article.show',$this) . $param;
	}
}
