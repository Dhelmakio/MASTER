<?php
spl_autoload_register('myAutoLoader');
	
function myAutoLoader($className){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    if(strpos($url, 'controller') !== false){
        $path = "../model/";
    }else{
        $path = "mvc/model/";
    }

    $extension = ".mod.php";
    $fullPath = $path . $className . $extension;

    if(!file_exists($fullPath)){
        return false;
    }

    require_once $fullPath;
}
