<?php

namespace GBFIC\MediaProvider\base;

use App;
use App\Models\Rss;
use GBFIC\MediaProvider\base\ProviderInterface;

abstract class AbstractMedia {
	
	protected $feed;
	protected $liveFeeds;
	protected $movies;
	
	protected $provider;
	
	function __construct(Rss $feed, $provider) {
    	$this->feed = $feed;
    	
    	$this->liveFeeds = $feed->liveVideo->where('status_code',(config('mediaproviders.active_only')) ? config('mediaproviders.active_code'): '');
    	$this->movies = $feed->videos;
      	$this->provider = $this->getProvider($provider);
    		
    }
   	
   	/**
   	 * This method will load the provider configuration
   	 * and try to resolve the provider uri to a class
   	 * and set that as the provider for this session
   	 * 
   	 **/
   	private function getProvider($providerUri){
   		
   		// Config that stores available media providers
   		$providers = config('mediaproviders.providers');
   		
   		// If the key exists, resolve it to an object and return it
   		// otherwise, throw an abort 501 becuase the feature hasnt been added.
       	$provider = (array_key_exists($providerUri, $providers )) ? $provider = new $providers[$providerUri] : App::abort(501, 'Provider not Found, please try again with a different provider'); 
      	
      	return $provider;
   	}
   	
}