<?php

//Set error mode to only show "errors" not warning,ect.
error_reporting(E_ALL);

// Time zone
date_default_timezone_set('UTC');

// Autoloader
require_once dirname(__FILE__).'/../vendor/autoload.php';

/*
 * Autoload classes that are required for testing when called.
 */
spl_autoload_register(function ($class_name) {

    $class = explode('\\', $class_name);
    $class_name = str_replace('\\', '/', $class_name);
    $classFile = 'src/'.$class_name.'/'.$class[count($class) - 1].'.php';
    require_once $classFile;
});
