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

You can get your client data by using the `getClient` method.

```php
$client = $MediaManager->API->getClient();
```

## Videos

You can get all your videos or a single video.

***Getting all videos***

```php
$videos = $MediaManager->API->getVideos();
```

***Getting a video***

```php
$videos = $MediaManager->API->getVideo("{videoid}");
```

## Analytics

You can get your accounts analytics also.

```php
//QUERY ANALYTICS
$query = $MediaManager->API->Analytics()->Query("{query}", "{from}", "{to}");
```

## Filtering

You can also filter down the content returned by the API.

```php
//ADD TEMPLATE FILTER
$MediaManager->API->addTemplateFilter("{template}");

//GET VIDEOS
$videos = $MediaManager->API->getVideos();
```

So this filter allows you to only return videos that are published to a given template. You can continue to add other filters.

```php
//ADD TEMPLATE FILTER
$MediaManager->API->addTemplateFilter("{template}");

//ADD PLAYLIST FILTER
$MediaManager->API->addPlaylistFilter("{playlist}");

//GET VIDEOS
$videos = $MediaManager->API->getVideos();
```

So now we only want to return videos that are published to a given template, but also published to a given playlist.

## Paging

Some API calls will return paged content. So the `getVideos` method will be returned as a `MediaManager\Pager\Pager` object. This can be easily iterated using a simple loop.

```php
//GET VIDEOS
$videos = $MediaManager->API->getVideos();

//LOOP THROUGH FIRST PAGE
foreach($videos as $key => $video){
   
}
```

***Pager filters***

Sometimes you may want to change the pager filters. For instance if you wanted to limit the number of items returned.

```php
//ADD A PAGE FILER
$MediaManager->API->addFilter("perPage","10");

//GET VIDEOS
$videos = $MediaManager->API->getVideos();
```

