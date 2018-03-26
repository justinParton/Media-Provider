<?php

namespace GBFIC\MediaProvider\Providers\Manager;

use Cache;
use Carbon\Carbon;

class CacheManager {
	
	public static function retrieve($key, $store = null){
		return ( Cache::has($key)) ?  Cache::get($key) : null;
	}
	
	public static function store($key, $value, Carbon $date, $store = null){
		($store != null) ? Cache::driver($store)->put($key, $value,$date) : Cache::put($key, $value, $date);
	}
	
	public static function remove($key, $store = null){
		($store != null) ? Cache::driver($store)->pull($key): Cache::pull($key);
	}
	
}