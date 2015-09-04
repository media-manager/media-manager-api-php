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

```
$client = $MediaManager->API->getClient();
```