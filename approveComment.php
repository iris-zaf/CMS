<?php
require_once("./Includes/Function.php");
require_once("./Includes/Session.php");
require_once("./Includes/DB.php");?>
<?php
if(isset($_GET["id"])){
    $SearchQueryParameter= $_GET["id"];
    global $ConnectingDB;
    $Admin= $_SESSION["AdminName"];
    $sql= "UPDATE comments SET status='ON', approvedby='$Admin' WHERE id='$SearchQueryParameter'";
$Execute=$ConnectingDB->query($sql);
    if($Execute){
        $_SESSION["SuccessMessage"]="Comment Approved Successfully";
        Redirect_to("comments.php");
    }else{
        $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
        Redirect_to("comments.php");

    }
}


?>