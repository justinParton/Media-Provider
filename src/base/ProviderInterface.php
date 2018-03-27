<<<<<<< HEAD
<?php

	namespace GBFIC\MediaProvider\base;
	
	interface ProviderInterface { 
		
	    public function getArray($feed, $liveFeeds, $movies);
	    public function getJson($feed, $liveFeeds, $movies);
	    public function getJsonp($feed, $liveFeeds, $movies, $callback);
	    public function getXml($feed, $liveFeeds, $movies);
	    
=======
<?php

	namespace GBFIC\MediaProvider\base;
	
	interface ProviderInterface { 
		
	    public function getArray($feed, $liveFeeds, $movies);
	    public function getJson($feed, $liveFeeds, $movies);
	    public function getJsonp($feed, $liveFeeds, $movies, $callback);
	    public function getXml($feed, $liveFeeds, $movies);
	    
>>>>>>> 63d04d1d99263bd772a6b6ab627cd24131213e37
	}