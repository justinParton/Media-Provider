<?php
namespace GBFIC\MediaProvider\Providers\Helpers\Roku;

use Illuminate\Database\Eloquent\Model;
use GBFIC\MediaProvider\Providers\Tasks\RemoteFeed;
use App\Models\Video;
use Carbon\Carbon;
use Validator;

class CreateRokuVideo
{
	const MP4_QUALITY    = "MP4",
          HLS_QUALITY    = "HLS",
          M4V_QUALITY    = "M4V",
          MOV_QUALITY    = "MOV",
          DASH_QUALITY   = "DASH",
          SMOOTH_QUALITY = "SMOOTH";
	
	
	public static function createMovie($video, $tags){
		return self::createContent($video, $tags);
	}
	
	
	public static function createLiveBroadcast($video, $tags){
		return self::createContent($video, $tags);
	}
	
	private static function createContent(Model $video, $tags){
		
		// Determine the Quality and Extension for this piece of content
		$extension = strtoupper(pathinfo($video->url)['extension']);
		$quality = null;
		
		switch($extension){
			case self::MP4_QUALITY:
				$quality = self::MP4_QUALITY;
				break;
			case self::M4V_QUALITY:
				$quality = self::M4V_QUALITY;
				break;
			case self::MOV_QUALITY:
				$quality = self::MOV_QUALITY;
				break;
			case self::MP4_QUALITY:
				$quality = self::SMOOTH_QUALITY;
				break;
			case self::MP4_QUALITY:
				$quality = self::DASH_QUALITY;
				break;
			case 'M3U8':
				$quality = self::HLS_QUALITY;
				break;
			default:
				// throw error
		}
		
		$item = array(
			"url" => $video->url,
			"quality" => "FHD",
			"videoType" => $quality
		);
		
		
		$content = array(
			"dateAdded" => (new Carbon($video->pubDate))->format('c') ,
			"videos" => array( $item),
			"duration" => (int) $video->length
		);
		
		if($quality == self::HLS_QUALITY){
			if(strlen($video->status_url) > 0){
				
				$event = RemoteFeed::retrieveJSON($video->status_url);
				$initialDate = Carbon::parse(gmdate("c", $event->result->liveStartTime))->timezone(date_default_timezone_get());
				$content['validityPeriodStart'] = $initialDate->format('c');
				$content['validityPeriodEnd'] = $initialDate->addHours(4)->format('c');
				
			}
		}
		
		// Create Video Array
		$releaseDate = new Carbon($video->pubDate);
		$item = array(
			"id" => ($video->live_id) ? $video->live_id : $video->video_id,
			"title" => $video->title,
			"content" => $content,
			"genres" => array('faith'),
			"thumbnail" => $video->thumb_url,
			"releaseDate" => (new Carbon($video->pubDate))->format('Y-m-d'), 
			"shortDescription" => $video->description,
			"longDescription" => $video->description,
			"tags" => $tags,
		);
		
		return $item;
		
	}
	  
}