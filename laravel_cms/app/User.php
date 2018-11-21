<?php

namespace App;

use App\Models\Attachments;
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
	//随机头像
	public function getIconAttribute( $key )
	{
		return $key?:asset('org/images/user.png');
	}
	//上传
	public function attachment(){
		return $this->hasMany(Attachments::class);
	}
}
