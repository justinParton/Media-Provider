<?php
namespace GBFIC\MediaProvider\Providers\Helpers\FireTv;

use Illuminate\Database\Eloquent\Model;
use App\Models\Video;
use Validator;
use Carbon\Carbon;

class CreateFireTvVideo
{

	const DATE_FORMAT = \DateTime::RSS;
	
	public static function createMovie(Model $video, $tags){

			$media = array(
				"id"=> (string) $video->id,
	            "title"=> $video->title,
	            "pubDate" => (new Carbon($video->pubDate, 'America/Chicago'))->format('l, F d, Y'),
	            "thumbURL"=> $video->thumb_url,
	            "imgURL"=> $video->thumb_url,
	            "videoURL"=> $video->url,
	            "type"=> "video",
	            "categories" => $tags,
	            "description"=> $video->description
	        );
	        
	        return $media;
	}
	
	public static function createLiveVideo(Model $video, $tags, $status){
		
		$media = array(
			"id"=> (string) $video->id,
            "title"=> $video->title,
            "thumbURL"=> $video->thumb_url,
            "imgURL"=> $video->thumb_url,
            "videoURL"=> $video->url,
            "type"=> "video-live",
            "alwaysLive"=> false,
            "description"=> $video->description
        );
   
		if(!$status){

			$sunday = new Carbon('next sunday');
			$wednesday = new Carbon('next wednesday');
			
			if(strtotime($sunday) < strtotime($wednesday)){
				$media["startTime"] = $sunday->addHours(10)->addMinutes(30)->format(self::DATE_FORMAT);
				$media["endTime"] = $sunday->addHours(3)->format(self::DATE_FORMAT);
			}else {
				$media["startTime"] = $wednesday->addHours(19)->addMinutes(15)->format(self::DATE_FORMAT);
				$media["endTime"] = $wednesday->addHours(2)->addMinutes(45)->format(self::DATE_FORMAT);
			}
		}
     	
        return $media;
	}
	  
}