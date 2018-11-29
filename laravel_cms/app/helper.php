<?php
if(!function_exists('hh_config')){
	function hh_config($val){
		static $cache=[];
		$info=explode('.',$val);
		if(!$cache){
			//清空所有缓存
			//Cache::flush();
			//获取缓存中config_cache数据,如果数据不存在,那么会以第二个参数作为默认值
			$cache = Cache::get('config_cache',function(){
				return \App\Models\Config::pluck('data','name');
			});

		}
		return $cache[$info[0]][$info[1]]??'';
	}
}