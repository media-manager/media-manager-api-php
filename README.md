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

**Getting all videos**

```php
$videos = $MediaManager->API->getVideos();
```

**Getting a video**

```php
$videos = $MediaManager->API->getVideo("{videoid}");
```

## Analytics

You can also query your analytics.

```php
//QUERY ANALYTICS
$query = $MediaManager->API->Analytics()->Query("{query}", "{from}", "{to}");
```

**Dates**

Dates can be in pretty much any format as long as they are a valid date.

```
2015-09-01
1st Jan 2015
etc..
```

**Query Language**

You can make use of the Media Manager Markup Langauge (MMML) or you can use the `QueryBuilder`. So using the MMML we can use the most basic query.

```
//QUERY ANALYTICS
$query = $MediaManager->API->Analytics()->Query("SHOW Video", "2015-08-04", "2015-09-04");
```

**Query Builder**

You can also make use of the Query Builder.

```php
$Query = new MediaManager\Analytics\Query();
```

You can then pass this into the `Query` method.

```php
$query = $MediaManager->API->Analytics()->Query($Query, "2015-08-04", "2015-09-04");
```

This will perform the most simple query, which would be `SHOW Video`. You can build on the query builder and add conditions and so on.

```php
$Show = $Query->Show;
```

The default `SHOW` is for videos, but you can change it by calling the `Show()` method.

```php
$Show = $Query->Show("Audio");
```

**Adding condition**

```php
$Show->Condition("title", "hello world");
```

By default the conditon will use the opreator `IS`. This can be changed by passing a third parameter.

```php
$Show->Condition("title", "hello world", "ISNOT");
```

When you have more than one conditon on a query a operator is used to seperate them. There are two options `AND`, `OR`. By default `AND` is used. This can be changed by setting the `Logical` method.

```php
$Show->Condition("title", "new")->Logical("OR");
$Show->Condition("title", "manager")->Logical("OR");
$Show->Condition("title", "test");
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

