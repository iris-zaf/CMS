<?
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$DSN = "mysql:host=$host;dbname=$dbname";
$ConnectingDB = new PDO($DSN, $user, $pass);//connect to the database


?>