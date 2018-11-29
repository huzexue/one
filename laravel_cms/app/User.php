<?php

namespace App;

use App\Models\Attachments;
use App\Models\Collect;
use App\Models\Zan;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','email_verified_at','icon'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

	//重写 数据库通知中 获取所有通知的 notifications 方法
	public function notifications()
	{
		return $this->morphMany(DatabaseNotification::class, 'notifiable')->orderBy('read_at', 'asc')->orderBy('created_at', 'desc');
	}
	//随机头像
	public function getIconAttribute( $key )
	{
		//dd($key);
		return $key?:asset('org/images/user.jpg');
	}
	//上传
	public function attachment(){
		return $this->hasMany(Attachments::class);
	}
	//获取粉丝
	public function fans(){

		return $this->belongsToMany(User::class,'followers','user_id','following_id');

	}
	//获取被关注的人
	public function following(){
		return $this->belongsToMany(User::class,'followers','following_id','user_id');
	}
	//用户关联 zan
	public function zan(){
		return $this->hasMany(Zan::class);
	}

	public function collect(){
		return $this->hasMany(Collect::class);
	}

}
