<?php

namespace App\Observers;

use App\Models\Config;

class ConfigObserver
{
    public function created(){
		$this->saveConfigToCache();
	}

	public function updated(){
		$this->saveConfigToCache();
	}

	public function saveConfigToCache(){
    	//dd(Config::pluck('name','data'));
    	\Cache::forever('config_cache',Config::pluck('name','data'));
	}
}
