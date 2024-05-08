<?php
require_once("./Includes/Function.php");
require_once("./Includes/Session.php");
require_once("./Includes/DB.php");?>
<?php
if(isset($_GET["id"])){
    $SearchQueryParameter= $_GET["id"];
    global $ConnectingDB;
    $sql= "DELETE FROM comments  WHERE id='$SearchQueryParameter'";
$Execute=$ConnectingDB->query($sql);
    if($Execute){
        $_SESSION["SuccessMessage"]="Comment Deleted Successfully";
        Redirect_to("comments.php");
    }else{
        $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
        Redirect_to("comments.php");

    }
}


?>