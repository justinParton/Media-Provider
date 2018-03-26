<?php
namespace GBFIC\MediaProvider\Providers\Tasks;

use App\Models\Rss;
use App\Models\Video;

use GBFIC\MediaProvider\Providers\Helpers\CreateRokuVideo;
use GBFIC\MediaProvider\Providers\Helpers\GenerateTags;
use Illuminate\Database\Eloquent\Collection;

class CreateRokuFeed
{
	
	public static function getMovies($feed){
		
		//Grab All Videos 
		$movies = array();
		
		foreach($feed->videos as $video){
			$tags = GenerateTags::getTags($video); 
			$item = CreateRokuVideo::createMovie($video, $tags);
			$movies[] = $item;
		}

		foreach($feed->liveVideo as $liveVideo){
				$tags = GenerateTags::getTags($liveVideo);
				$item = CreateRokuVideo::createLiveBroadcast($liveVideo, $tags);
				$movies[] = $item;
		}
	
		$rss_array = array(
			"providerName" => "Glory Bible Fellowship International Church",	
			"lastUpdated" => date('c', strtotime($feed->updated_at)),
		    "language" => "en",
		    "movies" => $movies
		);
	
		return $rss_array;
	}
	
	public static function getSeries($feed){
		
	}
}