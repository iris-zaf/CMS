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
$PostTitle= $_POST["PostTitle"];
$Category = $_POST["Category"];
$Image = $_FILES["image"]["name"]; 
$Target= "Upload/".basename($_FILES["image"]["name"]);  
$PostText= $_POST["PostDescription"];
$Admin =$_SESSION["Username"];
date_default_timezone_set("Europe/Athens");
$CurrentTime=time();
$DateTime=strftime("%Y-%m-%H:%M:%S" ,$CurrentTime);

if(empty($PostTitle)){
    $_SESSION["ErrorMessage"]= "Title can not be empty";
    Redirect_to("addNewPost.php");

}elseif(strlen(trim($PostTitle))<5){
    $_SESSION["ErrorMessage"]= "Post title should be at least 5 characters";
    Redirect_to("addNewPost.php");
}
elseif(strlen(trim($PostText))>999){
    $_SESSION["ErrorMessage"]= "Post description should be less than 1000 characters";
    Redirect_to("addNewPost.php");
}else{
    move_uploaded_file($_FILE["image"]["tmp_name"],$Target);
    //Query to insert post in DB
    $sql= "INSERT INTO posts(datetime,title,category,author,image,post)";
    $sql .= "VALUES(:dateTime,:postTitle,:categoryName,:adminName,:imageName,:postDescription)";
  
  $stmt = $ConnectingDB->prepare($sql); 
  $stmt->bindValue(':dateTime',$DateTime);
  $stmt->bindValue(':postTitle',$PostTitle);
    $stmt->bindValue(':categoryName',$Category);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':imageName',$Image);
    $stmt->bindValue(':postDescription',$PostText);
    $Execute=$stmt->execute();
    
    if ($Execute) {
    $_SESSION["SuccessMessage"]= "Post  added Successfully";
    Redirect_to("addNewPost.php");
     } else {
        $errorInfo = $stmt->errorInfo();
    $_SESSION["ErrorMessage"]= "SQL Error: " . $errorInfo[2]; // Show the detailed error message
    Redirect_to("addNewPost.php");

     }
    
    }
}

?>
<!DOCTYPE html>
<html lang="en-us">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="public_html/css/styles.css">
</head>

<body>
    <!-- navbar -->
    <div style="height:10px; background-color:#27aae1;"></div>
    <?php
require_once(TEMPLATES_PATH . "/navbar.php")
?>
    <div style="height:10px; background-color:#27aae1;"></div>
    <!-- main categories -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="col-lg-10 offset-lg-1" style="min-height:400px;">
                <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
                <form class="p-4" action="addNewPost.php" method="post" enctype="multipart/form-data">
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header">
                            <h1>Add New Post</h1>
                        </div>
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <label for="title" class="form-label"><span class="FieldInfo">Post Title:
                                    </span></label>
                                <input class="form-control" type="text" name="PostTitle" id="title"
                                    placeholder="Type Title here" value="">
                            </div>
                            <div class="form-group">
                                <label for="CategoryTitle" class="form-label"><span class="FieldInfo">Chose Category:
                                    </span></label>
                                <select class="form-control" id="CategoryTitle" name="Category">
                                    <?php
                                    //fetch categories from category table
                                  global $ConnectingDB;
                                  $sql= "SELECT id,title FROM categories";
                                  $stmt= $ConnectingDB->query($sql);
                                  while($DataRows = $stmt->fetch()){
                                    $Id= $DataRows["id"];
                                    $CategoryName= $DataRows["title"];
                                  
                                  ?>
                                    <option><?php echo $CategoryName; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mt-2 mb-1">
                                <div class="custom-file">
                                    <input class="custom-file-input" type="File" name="image" id="ImageSelect" value="">
                                    <label for="ImageSelect" class="custom-file-label">Select Image:</label>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="Post" class="form-label"><span class="FieldInfo">Post:
                                        <textarea class="form-control" id="Post" name="PostDescription" rows="8"
                                            cols="80"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mt-2">
                                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i
                                            class="fas fa-arrow-left"></i> Back
                                        To DashBoard</a>
                                </div>
                                <div class="col-lg-6 mt-2 ">
                                    <button type="submit" name="Submit" class="btn btn-success btn-block"><i
                                            class="fas fa-check"></i>
                                        Publish</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </section>



    <!-- footer -->
    <?php
require_once(TEMPLATES_PATH . "/footer.php")
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