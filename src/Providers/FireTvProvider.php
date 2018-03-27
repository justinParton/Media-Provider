<<<<<<< HEAD
<?php

namespace GBFIC\MediaProvider\Providers;

use App\Models\Rss;
use App\Models\Video;

use GBFIC\MediaProvider\base\ProviderInterface;
use GBFIC\MediaProvider\Providers\Tasks\RemoteFeed;
use GBFIC\MediaProvider\Providers\Helpers\FireTv\CreateFireTvVideo;
use GBFIC\MediaProvider\Providers\Helpers\GenerateTags;
use GBFIC\MediaProvider\Providers\Tasks\CacheTask;

use GBFIC\MediaProvider\Providers\Manager\CacheManager;
use Carbon\Carbon;

use FetchLeo\LaravelXml\Facades\Xml;

/***
 * 
 * This class provides media Feeds for FireTV applications
 * (really this can be for any Amazon Fire Device).
 *
 ***/
class FireTvProvider implements ProviderInterface {
    

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
    	$media = $this->getArray($feed, $liveFeeds, $movies);
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
    
    
    	$media_feed = CacheManager::retrieve(get_class().$feed->name);
    	
    	if($media_feed == null){

	       	$media_feed = array(
				"folders" => array(),
				"media" => array()
			);
			
			// Create Root Folder
			$media_feed['folders'][] = array(
				"id" => "1",
	            "title" => "root",
	            "description"=> "",
	            "contents" => array()		
			);
			
			if(count($liveFeeds) > 0) {
	
				$ids = array();
				foreach($liveFeeds as $liveVideo){
					
					$status = ($liveVideo->status_url) ? RemoteFeed::isLiveBroadcastActive($liveVideo->status_url) : false ;
					
					$tags = GenerateTags::getTags($liveVideo);
					$item = CreateFireTvVideo::createLiveVideo($liveVideo, $tags, $status);
	
					$ids[] = array("type"=>"media", "id" => $item['id']);
					$media_feed['media'][] = $item;
				}
				
				array_push($media_feed['folders'], 
							self::createFolder("Live Broadcast", "GBFIC Broadcasts", $ids, $media_feed['folders']));
							
				array_push( $media_feed['folders'][0]['contents'], 
							array("type" => "folder", "id" => (string) count($media_feed['folders']))); 
							
			}
			
			if(count($movies) > 0) {
				
				$ids = array();
				foreach($movies as $video){
					
					$tags = GenerateTags::getTags($video);
					$item = CreateFireTvVideo::createMovie($video, $tags);
					$ids[] = array("type"=>"media", "id" => $item['id']);
					$media_feed['media'][] = $item;
				}
				
				array_push($media_feed['folders'], 
							self::createFolder("Messeges", "Messages From GBFIC", $ids, $media_feed['folders']));
	
				array_push( $media_feed['folders'][0]['contents'], 
							array("type" => "folder", "id" => (string) count($media_feed['folders']))); 
			}
    	
    		CacheManager::store(get_class().$feed->name, $media_feed, Carbon::now()->addHours(1));
    	}

		return $media_feed;
    }
    
    /**
     * 
     * Reusable method to create a folder to latter be populated with media objects
     * 
     **/
    private static function createFolder($title, $description, $contents, $folders){
		
		$id =  count($folders) + 1;
		return array( "id" => (string) $id, "title" => $title, 
					  "description"=> $description, "contents" => $contents);
	}

=======
<?php

namespace GBFIC\MediaProvider\Providers;

use App\Models\Rss;
use App\Models\Video;

use GBFIC\MediaProvider\base\ProviderInterface;
use GBFIC\MediaProvider\Providers\Tasks\RemoteFeed;
use GBFIC\MediaProvider\Providers\Helpers\FireTv\CreateFireTvVideo;
use GBFIC\MediaProvider\Providers\Helpers\GenerateTags;
use GBFIC\MediaProvider\Providers\Tasks\CacheTask;

use GBFIC\MediaProvider\Providers\Manager\CacheManager;
use Carbon\Carbon;

use FetchLeo\LaravelXml\Facades\Xml;

/***
 * 
 * This class provides media Feeds for FireTV applications
 * (really this can be for any Amazon Fire Device).
 *
 ***/
class FireTvProvider implements ProviderInterface {
    

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
    	$media = $this->getArray($feed, $liveFeeds, $movies);
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
    
    
    	$media_feed = CacheManager::retrieve(get_class().$feed->name);
    	
    	if($media_feed == null){

	       	$media_feed = array(
				"folders" => array(),
				"media" => array()
			);
			
			// Create Root Folder
			$media_feed['folders'][] = array(
				"id" => "1",
	            "title" => "root",
	            "description"=> "",
	            "contents" => array()		
			);
			
			if(count($liveFeeds) > 0) {
	
				$ids = array();
				foreach($liveFeeds as $liveVideo){
					
					$status = ($liveVideo->status_url) ? RemoteFeed::isLiveBroadcastActive($liveVideo->status_url) : false ;
					
					$tags = GenerateTags::getTags($liveVideo);
					$item = CreateFireTvVideo::createLiveVideo($liveVideo, $tags, $status);
	
					$ids[] = array("type"=>"media", "id" => $item['id']);
					$media_feed['media'][] = $item;
				}
				
				array_push($media_feed['folders'], 
							self::createFolder("Live Broadcast", "GBFIC Broadcasts", $ids, $media_feed['folders']));
							
				array_push( $media_feed['folders'][0]['contents'], 
							array("type" => "folder", "id" => (string) count($media_feed['folders']))); 
							
			}
			
			if(count($movies) > 0) {
				
				$ids = array();
				foreach($movies as $video){
					
					$tags = GenerateTags::getTags($video);
					$item = CreateFireTvVideo::createMovie($video, $tags);
					$ids[] = array("type"=>"media", "id" => $item['id']);
					$media_feed['media'][] = $item;
				}
				
				array_push($media_feed['folders'], 
							self::createFolder("Messeges", "Messages From GBFIC", $ids, $media_feed['folders']));
	
				array_push( $media_feed['folders'][0]['contents'], 
							array("type" => "folder", "id" => (string) count($media_feed['folders']))); 
			}
    	
    		CacheManager::store(get_class().$feed->name, $media_feed, Carbon::now()->addHours(1));
    	}

		return $media_feed;
    }
    
    /**
     * 
     * Reusable method to create a folder to latter be populated with media objects
     * 
     **/
    private static function createFolder($title, $description, $contents, $folders){
		
		$id =  count($folders) + 1;
		return array( "id" => (string) $id, "title" => $title, 
					  "description"=> $description, "contents" => $contents);
	}

>>>>>>> 63d04d1d99263bd772a6b6ab627cd24131213e37
}