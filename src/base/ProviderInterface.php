<?php

	namespace GBFIC\MediaProvider\base;
	
	interface ProviderInterface { 
		
	    public function getArray($feed, $liveFeeds, $movies);
	    public function getJson($feed, $liveFeeds, $movies);
	    public function getJsonp($feed, $liveFeeds, $movies, $callback);
	    public function getXml($feed, $liveFeeds, $movies);
	    
	}