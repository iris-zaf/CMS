<?php
$config=array(
"paths"=>array(
    "resources"=>"../resources",
)
);
defined("INCLUDES_PATH")
	or define("INCLUDES_PATH", realpath(dirname(__FILE__) . '/../Includes'));

    $host = getenv('DB_HOST') ?: 'localhost';
    $dbname = getenv('DB_NAME') ?: 'cms';
    $user = getenv('DB_USER') ?: 'root';
    $pass = getenv('DB_PASS') ?: '4499';

    
    // Set the database configuration
$databaseConfig = array(
    'host' => $host,
    'dbname' => $dbname,
    'user' => $user,
    'pass' => $pass,
);

ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRICT);
?>