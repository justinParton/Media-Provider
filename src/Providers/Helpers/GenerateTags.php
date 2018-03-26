<?php
namespace GBFIC\MediaProvider\Providers\Helpers;

use Validator;

class GenerateTags
{
	
	public static function getTags($video){
		
		$tags = array();
		foreach(explode (",",$video->keywords) as $keyword){
			$tags[] = $keyword;
		}
		
		return $tags;
		
	}
	  
}