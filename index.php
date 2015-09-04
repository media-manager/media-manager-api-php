<?Php

error_reporting(-1);
ini_set('display_errors', 'On');

//AUTO LOAD
include("MediaManager/autoload.php");

//CREATE MEDIAMANAGER INSTANCE
$MediaManager = new \MediaManager\MediaManager("demo", "b0af2167d695ab80c0009a77bf6e89217b743a32");


//ADD A PLAYLIST FILTER
$MediaManager->API->addPlaylistFilter("53d90f56150ba0996c8b4608");
$MediaManager->API->addTemplateFilter("5409d798140ba0a47c8b4604");

//GET CLIENT
$videos = $MediaManager->API->getVideos();


var_dump($videos);