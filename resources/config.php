<?php
$config=array(
"paths"=>array(
    "resources"=>"../resources",
)
);
defined("INCLUDES_PATH")
	or define("INCLUDES_PATH", realpath(dirname(__FILE__) . '/../Includes'));

$host = 'localhost';
$dbname ='cms';
$user = 'root';
$pass = '4499';


ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRICT);
?>