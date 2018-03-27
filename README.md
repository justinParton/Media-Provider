# Media Feed Providers

This package aims to provide feeds (XML,JSON,JSONP) that are specifically taylored to the Provider requesting.

## Installation

Installation Notes will follow once the project has been added to packagist


### Service Provider

#### In your app config, add the `LaravelFacebookSdkServiceProvider` to the providers array.

```php
'providers' => [
    GBFIC\MediaProvider\MediaServiceProvider::class,
    ];
```
#### Publish the necessary config files

```
	php artisan vendor:publish
```
	
#### Migrations

Migrations will be added soon to provide a standardised data set for providers to work with.

### Usage Example

#### Create a Provider
	
	To create a provider, create a class that implements GBFIC\MediaProvider\Providers\ProviderInterface
	and implement the required methods. 
	
	Dont forget to add the provider to config/mediaprovider providers array so that it can be retrieved during initialization. 

	
#### Initializing MediaProvider

	After you have created a provider:
	
``` php

	// Initialize MediaProvider
	$media = new Media(
		$dataFromDatabase, 
		$provider
	);
		
```

Every provider is requried to support json,xml, or jsonp. So call the necessary method to get the feed.
	
``` php
	// Every provider is requried to support json & xml. So call the necessary method to get the feed.
	$mediaFeed = response($media->getJson())->header('Content-Type', 'application/json');
	$mediaFeed = response($media->getXml()->asXML())->header('Content-Type', 'text/xml');
	$mediaFeed = response($media->getJsonp("media"))->header('Content-Type', 'application/json');
```

