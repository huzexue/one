<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Comment extends Model
{
	###################全局动态；————————————————————————————————————
	use LogsActivity;
	protected $fillable = ['content','article_id'];
	//记录$fillable所有的字段
	protected static $logFillable = true;
	//模型动作属性
	protected static $recordEvents = ['created','updated'];
	//自定义日志
	protected static $logName = 'comment';
	###################全局动态；————————————————————————————————
	protected $casts = [
		'created_at' => 'datetime:Y-m-d',
	];

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function zan(){
		return $this->morphMany(Zan::class,'zan');
	}

	//评论关联通知
	public function article(){
		return $this->belongsTo(Article::class);
	}
}
