<?php

namespace GBFIC\MediaProvider;

use GBFIC\MediaProvider\base\AbstractMedia;
use GBFIC\MediaProvider\base\ProviderInterface;


class Media extends AbstractMedia {
	
	function getJson() {
		return $this->provider->getJson( $this->feed, $this->liveFeeds, $this->movies );
    }
    
    function getJsonp($callback) {
		return $this->provider->getJsonp($this->feed, $this->liveFeeds, $this->movies, $callback );
    }
    
    function getXml() {
		return $this->provider->getXml($this->feed, $this->liveFeeds, $this->movies );
    }
    
}