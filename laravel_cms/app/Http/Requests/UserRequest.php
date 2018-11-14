<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'email|unique:users',
			'name'=>'required|min:3',
			'password'=>'required|min:3|confirmed',
			'code'=>[
				'required',
				function ($attribute, $value, $fail) {
        			//dd(session('code'));
					if ($value!=session('code')) {
						$fail('验证码错误');
					}
				},
			],

        ];
		//return [];

    }

    public function messages()
	{
		return [
			'email.email'=>'邮箱格式不正确',
			'email.unique'=>'邮箱已被注册',
			'name.required'=>'昵称不能为空',
			'name.min'=>'昵称不能少于三个字符',
			'password.required'=>'密码不能为空',
			'password.min'=>'密码太过简单',
			'password.confirmed'=>'两次密码不一致',
			'code.required'=>'验证码不正确',
		];
	}
}
