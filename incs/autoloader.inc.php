<?php

spl_autoload_register('myAutoloader');

function myAutoloader($className){
    $path = "config/";
    $extension = ".config.php";
    $fullPath = $path . $className . $extension;

    include_once $fullPath;
}


?>