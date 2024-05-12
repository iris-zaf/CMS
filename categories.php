<?php
require_once("./resources/config.php");
require_once("./Includes/Function.php");
require_once("./Includes/Session.php");
require_once("./Includes/DB.php");?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];

Confirm_Login();?>
<?php
if(isset($_POST["Submit"])){
$Category= $_POST["CategoryTitle"];
$Admin =$_SESSION["Username"];
date_default_timezone_set("Europe/Athens");
$CurrentTime=time();
$DateTime=strftime("%Y-%m-%H:%M:%S" ,$CurrentTime);

if(empty($Category)){
    $_SESSION["ErrorMessage"]= "Please Enter Category Title";
    Redirect_to("categories.php");

}elseif(strlen(trim($Category))<3){
    $_SESSION["ErrorMessage"]= "Category title should be at least 3 characters";
    Redirect_to("categories.php");
}
elseif(strlen(trim($Category))>49){
    $_SESSION["ErrorMessage"]= "Category title should be less than 50 characters";
    Redirect_to("categories.php");
}else{
    //Query to insert category in DB
    $sql= "INSERT INTO categories(title,author,datetime)";
    $sql .= "VALUES(:categoryName,:adminName,:dateTime)";
    $stmt = $ConnectingDB->prepare($sql);

    $stmt->bindValue(':categoryName',$Category);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':dateTime',$DateTime); 
    $Execute=$stmt->execute();
    if ($Execute) {
    $_SESSION["SuccessMessage"]= "Category Added Successfully";
    Redirect_to("categories.php");
     } else {
        $_SESSION["ErrorMessage"]= "Something went wrong while adding the Category Try Again Later
        or Contact Support team for further assistance.";
        Redirect_to("categories.php");

     }
    
    }
}

?>

<?php
$title='Add New Category';
require_once(INCLUDES_PATH . "/navbar.php")
?>
<div style="height:10px; background-color:#27aae1;"></div>
<!-- main categories -->
<section class="container py-2 mb-4">
    <div class="row">
        <div class="col-lg-8 offset-lg-1" style="min-height:400px;">
            <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
            <form class="p-4" action="categories.php" method="post">
                <div class="card  text-dark mb-3 glassmorphic-card ">
                    <div class="card-header">
                        <h1>Add New Category</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" class="form-label"><span class="FieldInfo">Category Title:
                                </span></label>
                            <input class="form-control" type="text" name="CategoryTitle" id="title"
                                placeholder="Type Title here" value="">
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between flex-wrap">

                        <div class="mt-2">
                            <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>
                                Back
                                To DashBoard</a>
                        </div>
                        <div class="mt-2">
                            <button type="submit" name="Submit" class="btn btn-success btn-block"><i
                                    class="fas fa-plus"></i> Add </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>



<!-- footer -->
<?php
require_once(INCLUDES_PATH . "/footer.php")
?>