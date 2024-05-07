<?php
require_once("./Includes/Function.php");
require_once("./Includes/Session.php");
?>

<?php 
$_SESSION["UserID"]=null;
$_SESSION["Username"]=null;
$_SESSION["AdminName"]=null;
session_destroy();
Redirect_to("Login.php");


?>