<?php
namespace  GBFIC\MediaProvider\Providers\Tasks;

use Cache;
use Carbon\Carbon;

class CacheTask
{
	
	public static function retrieveFromCache(string $key){
		return Cache::get($key);
	}
	
	public static function storeInCache(string $key, $value){
		$expiresAt = Carbon::now()->addHours(3);
		Cache::put($key, $value, $expiresAt);
	}
}