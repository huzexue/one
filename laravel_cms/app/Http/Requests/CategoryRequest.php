<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	//判断是否登录，登录为true，未登录是false;
        return auth()->check();

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    	$id=$this->route('category')?$this->route('category')->id:null;
        return [
            'title'=>'required|unique:categories,title'.$id,
			'icon'=>'required',
        ];
    }

    public function messages()
	{
		return [
			'title.required'=>'栏目名称不能为空',
			'title.unique'=>'栏目已经存在',
			'icon.required'=>'文字图标不能为空',
		];
	}
}
