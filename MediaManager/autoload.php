<?php

function __autoload($class_name) {
    $parts = explode("\\", $class_name);
    include implode("/", $parts) . ".php";
}
