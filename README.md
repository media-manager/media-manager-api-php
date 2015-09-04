# Media Manager API - PHP

A PHP library for interacting with the Media Maanger APIs

## Setting up

```php
//AUTO LOAD
include("MediaManager/autoload.php");

//CREATE MEDIAMANAGER INSTANCE
$MediaManager = new \MediaManager\MediaManager("{shortname}", "{apikey}");
```

## Client

You can get your client data by using the getClient method.

```php
$client = $MediaManager->API->getClient();
```

## Videos

You can get all your videos or a single video.

### Getting all videos

```php
$videos = $MediaManager->API->getVideos();
```

### Getting a video

```php
$videos = $MediaManager->API->getVideo("{videoid}");
```

### Filtering

You can also filter down the content returned by the API.

```php
//ADD TEMPLATE FILTER
$MediaManager->API->addTemplateFilter("5409d798140ba0a47c8b4604");

//GET VIDEOS
$videos = $MediaManager->API->getVideos();
```

So this filter allows you to only return videos that are published to a given template. You can continue to add other filters.

```php
//ADD TEMPLATE FILTER
$MediaManager->API->addTemplateFilter("5409d798140ba0a47c8b4604");

//ADD PLAYLIST FILTER
$MediaManager->API->addPlaylistFilter("53d90f56150ba0996c8b4608");

//GET VIDEOS
$videos = $MediaManager->API->getVideos();
```

So now we only want to return videos that are published to a given template, but also published to a given playlist.

