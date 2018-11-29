<?php

namespace App\Http\Controllers\Util;

use App\Exceptions\UploadException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
	public function __construct(){
		$this->middleware('auth',[
			'only'=>['uploader','checkSize','checkType','filesLists']
		]);
	}
    public function uploader(Request $request){
		//dd($_FILES['file']);
		$file=$request->file('file');
		$this->checkSize($file);
		$this->checkType($file);
		if($file){
			$path=$file->store('attachment','attachment');
			auth()->user()->attachment()->create([
				'name'=>$file->getClientOriginalName(),
				'path'=>url($path)
			]);
		}
		return ['file' =>url($path), 'code' => 0];
	}

	protected function checkSize($file){
		if($file->getSize() > 20000000){
			throw new UploadException('文件超过限制大小');
		}
	}

	protected function checkType($file){
		if(!in_array(strtolower($file->getClientOriginalExtension()),['jpg','png','jpeg'])){

			throw new UploadException('类型不允许');
		}
	}

	public function filesLists(){
		$files = auth()->user()->attachment()->paginate(20);
		$data = [];
		foreach($files as $file){
			//dd($file->toArray());
			$data[] = [
				'url'=>$file['path'],
				'path'=>$file['path']
			];
		}
		return [
			'data'=>$data,
			'page'=>$files->links() . '',
			'code'=> 0
		];
	}
}
