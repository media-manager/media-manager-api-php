# Media Manager API - PHP

A PHP library for interacting with the Media Maanger APIs

## Setting up

```
//AUTO LOAD
include("MediaManager/autoload.php");

//CREATE MEDIAMANAGER INSTANCE
$MediaManager = new \MediaManager\MediaManager("{shortname}", "{apikey}");
```

## Client

You can get your client data by using the getClient method.

```
$client = $MediaManager->API->getClient();
```

## Videos

You can get all your videos or a single video.

### Getting all videos

```
$videos = $MediaManager->API->getVideos();
```

### Getting a video

```
$videos = $MediaManager->API->getVideo("{videoid}");
```
