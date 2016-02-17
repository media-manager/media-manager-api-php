<?Php

error_reporting(-1);
ini_set('display_errors', 'On');

//AUTO LOAD
include 'MediaManager/autoload.php';

//CREATE MEDIAMANAGER INSTANCE
$MediaManager = new \MediaManager\MediaManager('demo', '{apikey}');

//ADD A PLAYLIST FILTER
$MediaManager->API->addPlaylistFilter('{playlist}');
$MediaManager->API->addTemplateFilter('{template}');

//GET CLIENT
$videos = $MediaManager->API->getVideos();
