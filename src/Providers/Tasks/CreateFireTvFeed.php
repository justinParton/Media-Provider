<?php
namespace GBFIC\MediaProvider\Providers\Tasks;

use App\Models\Rss;
use App\Models\Video;


use App\Tasks\RemoteFeed;

use GBFIC\MediaProvider\Providers\Helpers\FireTv\CreateFireTvVideo;
use GBFIC\MediaProvider\Providers\Helpers\GenerateTags;
use Illuminate\Database\Eloquent\Collection;

class CreateFireTvFeed
{
    
    // https://developer.amazon.com/docs/app-submission/getting-started.html
    
	public static function getMovies($feed){
		
		$rss_array = array(
			"folders" => array(),
			"media" => array()
		);
		
		
		// Create Root Folder
		$rss_array['folders'][] = array(
			"id" => "1",
            "title" => "root",
            "description"=> "",
            "contents" => array()		
		);
		
		$liveVideos = $feed->liveVideo;
		if(count($liveVideos) > 0) {

			$ids = array();
			foreach($liveVideos as $liveVideo){
				
				$status = ($liveVideo->status_url) ? RemoteFeed::isLiveBroadcastActive($liveVideo->status_url) : false ;
				
				$tags = GenerateTags::getTags($liveVideo);
				$item = CreateFireTvVideo::createLiveVideo($liveVideo, $tags, $status);

				$ids[] = array("type"=>"media", "id" => $item['id']);
				$rss_array['media'][] = $item;
			}
			
			array_push($rss_array['folders'], 
						self::createFolder("Live Broadcast", "GBFIC Broadcasts", $ids, $rss_array['folders']));
						
			array_push( $rss_array['folders'][0]['contents'], 
						array("type" => "folder", "id" => (string) count($rss_array['folders']))); 
						
		}
		
		$videos = $feed->videos;
		if(count($videos) > 0) {
			
			$ids = array();
			foreach($videos as $video){
				
				$tags = GenerateTags::getTags($video);
				$item = CreateFireTvVideo::createMovie($video, $tags);
				$ids[] = array("type"=>"media", "id" => $item['id']);
				$rss_array['media'][] = $item;
			}
			
			array_push($rss_array['folders'], 
						self::createFolder("Messeges", "Messages From GBFIC", $ids, $rss_array['folders']));

			array_push( $rss_array['folders'][0]['contents'], 
						array("type" => "folder", "id" => (string) count($rss_array['folders']))); 
		}
		
		return $rss_array;
		
	}
	
	private static function createFolder($title, $description, $contents, $folders){
		
		$id =  count($folders) + 1;
		return array( "id" => (string) $id, "title" => $title, 
					  "description"=> $description, "contents" => $contents);
	}
	  
}