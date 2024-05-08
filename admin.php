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
$Username= $_POST["username"];
$Name= $_POST["name"];
$Password = $_POST["password"];
$ConfirmPassword = $_POST["confirmPassword"];
$Admin=$_SESSION["Username"];
date_default_timezone_set("Europe/Athens");
$CurrentTime=time();
$DateTime=strftime("%Y-%m-%H:%M:%S" ,$CurrentTime);

if(empty($Username)||empty($Password)||empty($ConfirmPassword)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("admin.php");

}elseif($Password<4){
    $_SESSION["ErrorMessage"]= "Password title should be at least 4 characters";
    Redirect_to("admin.php");
}
elseif($Password !== $ConfirmPassword){
    $_SESSION["ErrorMessage"]= "Passwords should match";
    Redirect_to("admin.php");
}elseif(CheckUserExists($Username)){
    $_SESSION["ErrorMessage"]= "User already exists, try another username";
    Redirect_to("admin.php");
}
else{
    //Query to insert new admin in DB
    $sql= "INSERT INTO admins(datetime,username,password,aname,addedby)";
    $sql .= "VALUES(:dateTime,:userName,:password,:aName,:adminName)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':dateTime',$DateTime);
    $stmt->bindValue(':userName',$Username);
    $stmt->bindValue(':password',$Password); 
    $stmt->bindValue(':aName',$Name); 
    $stmt->bindValue(':adminName',$Admin); 
    $Execute=$stmt->execute();
    if ($Execute) {
    $_SESSION["SuccessMessage"]= "New Admin Added Successfully";
    Redirect_to("admin.php");
     } else {
        $_SESSION["ErrorMessage"]= "Something went wrong while adding the admin";
        Redirect_to("admin.php");

     }
    
    }
}

?>
<!DOCTYPE html>
<html lang="en-us">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="public_html/css/styles.css">
</head>

<body>
    <!-- navbar -->
    <div style="height:10px; background-color:#27aae1;"></div>
    <?php
require_once(INCLUDES_PATH . "/navbar.php")
?>
    <div style="height:10px; background-color:#27aae1;"></div>
    <div class="container"><i class="fas fa-user"></i>Manage Admins</div>
    <!-- main categories -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="col-lg-10 offset-lg-1" style="min-height:400px;">
                <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
                <form class="p-4" action="admin.php" method="post">
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header">
                            <h1>Add New Admin</h1>
                        </div>
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <label for="username" class="form-label"><span class="FieldInfo">Username:
                                    </span></label>
                                <input class="form-control" type="text" name="username" id="username"
                                    placeholder="Type Username here" value="">

                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label"><span class="FieldInfo">Name:
                                    </span></label>
                                <input class="form-control" type="text" name="name" id="name"
                                    placeholder="Type Name here" value="">
                                <small class="text-warning">Optional</small>

                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label"><span class="FieldInfo">Password:
                                    </span></label>
                                <input class="form-control" type="password" name="password" id="password"
                                    placeholder="Type Password here" value="">
                            </div>

                            <div class="form-group">
                                <label for="confirmPassword" class="form-label"><span class="FieldInfo">Confirm
                                        Password:
                                    </span></label>
                                <input class="form-control" type="password" name="confirmPassword" id="confirmPassword"
                                    placeholder="Confirm Password" value="">
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mt-2">
                                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i
                                            class="fas fa-arrow-left"></i>
                                        Back
                                        To DashBoard</a>
                                </div>
                                <div class="col-lg-6 mt-2 ">
                                    <button type="submit" name="Submit" class="btn btn-success btn-block"><i
                                            class="fas fa-check"></i>
                                        Publish</button>
                                </div>
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

    <script src="https://kit.fontawesome.com/e3a678f973.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
    $('#year').text(new Date().getFullYear());
    </script>
</body>

</html>