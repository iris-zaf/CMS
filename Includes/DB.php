<?php
include './resources/config.php';
$DSN = "mysql:host=$host;dbname=$dbname";
$ConnectingDB = new PDO($DSN, $user, $pass);//connect to the database
?>