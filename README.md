# Media Feed Providers

This package Readme file is currently under development and will be updated once all services have been implemented.

This package aims to provide feeds (XML,JSON,JSONP) that are specifically taylored to the Provider requesting.

## Installation

Installation Notes will follow once the project has been added to packagist


### Service Provider

#### In your app config, add the `MediaServiceProvider` to the providers array.

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
	
Providers are essential to transforming data from the database to a feed for users. To create a provider, create a class that implements GBFIC\MediaProvider\Providers\ProviderInterface and add the required methods that will transform your data. For examples see:

```
GBFIC\MediaProvider\Providers\FireTvProvider;
GBFIC\MediaProvider\Providers\RokuProvider;
```
 
Once you have created a provider, add it to the config file so that it is retrievable during runtime.
	
#### Initializing MediaProvider

After you have created a provider, simply create the Media object that takes two parameters, The data that you will transform, and the key associated with your provider (stored in the config) :

``` php

	// Initialize MediaProvider
	$media = new Media(
		$dataFromDatabase, 
		$provider
	);
		
```

Since every provider is requried have three basic methods, you can reliably call the following three methods to get feed data.
	
``` php
	// Every provider is requried to support json & xml. So call the necessary method to get the feed.
	$mediaFeed = response($media->getJson())->header('Content-Type', 'application/json');
	$mediaFeed = response($media->getXml()->asXML())->header('Content-Type', 'text/xml');
	$mediaFeed = response($media->getJsonp("media"))->header('Content-Type', 'application/json');
```

#### GraphQL

Please see the graphql config file in the /app/Config directory for api locations and Query & Trait Sample Files.

