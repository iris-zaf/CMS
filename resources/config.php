<?php
$config=array(
"paths"=>array(
    "resources"=>"../resources",
)
);
defined("TEMPLATES_PATH")
	or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));
/* 
Error reporting. 
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);
?>