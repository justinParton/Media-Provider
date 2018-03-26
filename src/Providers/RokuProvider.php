<?php

namespace GBFIC\MediaProvider\Providers;

use App\Models\Rss;
use App\Models\Video;

use GBFIC\MediaProvider\base\ProviderInterface;
use GBFIC\MediaProvider\Providers\Helpers\Roku\CreateRokuVideo;
use GBFIC\MediaProvider\Providers\Helpers\GenerateTags;
use GBFIC\MediaProvider\Providers\Tasks\RemoteFeed;
use GBFIC\MediaProvider\Providers\Tasks\CacheTask;

use FetchLeo\LaravelXml\Facades\Xml;

/***
 * 
 * This class provides media Feeds for Roku applications.
 *
 ***/
class RokuProvider implements ProviderInterface {

     /**
     * 
     * This method calls getArray, and then encodes the array to json
     * 
     **/
   	public function getJson($feed, $liveFeeds, $movies){
   		return json_encode($this->getArray($feed,$liveFeeds,$movies));
   	}
   	
   	/**
     * 
     * This method calls getArray, and then encodes the array to jsonp
     * using the provided callback text
     * 
     **/
    public function getJsonp($feed, $liveFeeds, $movies, $callback){
    	$feed = $this->getArray($feed,$liveFeeds,$movies);
    	return json_encode(Array($callback => $feed));
    	
    }
    
    /**
     * 
     * This method calls getArray, and then encodes the array to xml
     * 
     **/
    public function getXml($feed, $liveFeeds, $movies){
    	$media = $this->getArray($feed, $liveFeeds, $movies);
    	return Xml::convert($media);
    }
    
     /** 
     * 
     * This method creates the array of data that is expected by the Caller
     * This method will not encode the data (XML,JSON), only provide the data
     * in array format
     * 
     **/
    public function getArray($feed,$liveFeeds,$movies){
    	
    
		//Grab All Videos 
		$videos = array();
		
		foreach($movies as $video){
			
			$tags = GenerateTags::getTags($video); 
			$item = CreateRokuVideo::createMovie($video, $tags);
			$videos[] = $item;
		}

		foreach($liveFeeds as $liveVideo){
		
				$tags = GenerateTags::getTags($liveVideo);
				$item = CreateRokuVideo::createLiveBroadcast($liveVideo, $tags);
				$videos[] = $item;
			
		}
		
		$groupings = $this->generateGroupings($videos);
	
		$media_feed = array(
			"providerName" => "Glory Bible Fellowship International Church",	
			"lastUpdated" => date('c', strtotime($feed->updated_at)),
		    "language" => "en",
		    "movies" => $videos,
		    "categories" => $groupings[0],
		    "playlists" => $groupings[1]
		);
    	

		return $media_feed;
    }
    
    /*
    * This will create the dynamic categories 
    * based on the tags that are provided.
    */
    private function generateGroupings($videos){
    	
    	$allTags = array();
    	$categories = array();
		$playlists = array();
		
		foreach($videos as $video){
			foreach($video['tags'] as $tag){
				if(array_key_exists($tag, $allTags)){
					$allTags[$tag][] = $video['id'];
				} else{
					$allTags[$tag] = array($video['id']);
				}
			}
		}
		
		foreach($allTags as $tag => $ids){
			
			$playlists[] = array(
				"name" => $tag,
				"itemIds" => $ids
			);
			
			$categories[] = array(
				"name" => $tag,
				"playlistName" => $tag,
				"order" => "most_recent"
			);
			
		}
		return array($categories, $playlists);
    }
}