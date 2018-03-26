<?php
namespace  GBFIC\MediaProvider\Providers\Tasks;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class RemoteFeed
{
	
	public static function retrieveXML(string $url){
		
		//	***** CREATE FEED
		$client = new Client(); //GuzzleHttp\Client
		$response = $client->request('GET', $url)->getBody()->getContents();
		return simplexml_load_string($response);

	}
	
	public static function retrieveJSON(string $url){
		
		//	***** CREATE FEED
		$client = new Client(); //GuzzleHttp\Client
		$response = $client->request('GET', $url)->getBody()->getContents();
		return json_decode($response);

	}
	
	public static function isLiveBroadcastActive($url){
		$feed = self::retrieveJSON($url);
		return ($feed->result->onAir == 'true') ? true : false;
	}
	
	  
}