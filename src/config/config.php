<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Available Providers
    |--------------------------------------------------------------------------
    |
    | List of Providers that can be used to return Feeds.
    |
    */
    'providers' => [
    	
    	'roku' => GBFIC\MediaProvider\Providers\RokuProvider::class,
		'firetv' => GBFIC\MediaProvider\Providers\FireTvProvider::class,
		
	],
	
	/*
    |--------------------------------------------------------------------------
    | Caching Options
    |--------------------------------------------------------------------------
    |
    | Activate/Deactivate cacheing of the feeds, and what store to use
    |
    */
	'cache' => true,
	'cache_manager' => 'apc',
	
	
	/*
    |--------------------------------------------------------------------------
    | Show Active Records Only
    |--------------------------------------------------------------------------
    |
    | Only Show Active Records. If active_only is true, change 'active_code' to
    | whatever string represents active in your system.
    |
    */
    
    'active_only' => true,
    'active_code' => 'ACT',
];
