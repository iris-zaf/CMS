<?php
require_once("./resources/config.php");
require_once("./Includes/Function.php");
require_once("./Includes/Session.php");
require_once("./Includes/DB.php");?>
<?php Confirm_Login();?>

<?php
$SearchQueryParameter = $_GET['id'];
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
    Redirect_to("posts.php");

}elseif(strlen(trim($PostTitle))<5){
    $_SESSION["ErrorMessage"]= "Post title should be at least 5 characters";
    Redirect_to("posts.php");
}
elseif(strlen(trim($PostText))>9999){
    $_SESSION["ErrorMessage"]= "Post description should be less than 1000 characters";
    Redirect_to("posts.php");
}else{

global $ConnectingDB;
if(!empty($Image)) {
    $sql= "UPDATE  posts 
            SET title='$PostTitle',category='$Category', image='$Image',post='$PostText' 
            WHERE id='$SearchQueryParameter'";
}else{
    $sql= "UPDATE  posts 
    SET title='$PostTitle',category='$Category', post='$PostText' 
    WHERE id='$SearchQueryParameter'"; 
}


    $Execute=$ConnectingDB->query($sql);
    move_uploaded_file($_FILE["image"]["tmp_name"],$Target);
  
    
    if ($Execute) {
    $_SESSION["SuccessMessage"]= "Post  updated Successfully";
    Redirect_to("posts.php");
     } else {
        $errorInfo = $stmt->errorInfo();
    $_SESSION["ErrorMessage"]= "SQL Error: " . $errorInfo[2]; // Show the detailed error message
    Redirect_to("posts.php");

     }
    
    }
}

?>

<?php
$tittle='Edit a Post';
require_once(INCLUDES_PATH . "/navbar.php")
?>
<div style="height:10px; background-color:#27aae1;"></div>
<!-- main categories -->
<section class="container py-2 mb-4">
    <div class="row">
        <div class="col-lg-10 offset-lg-1" style="min-height:400px;">
            <?php
            echo ErrorMessage();
            echo SuccessMessage();
            global $ConnectingDB;
            $sql= "SELECT * FROM posts WHERE id='$SearchQueryParameter'";
            $stmtPost= $ConnectingDB->query($sql);
            while($DataRows=$stmtPost->fetch()){
                $TitleUpdate = $DataRows['title'];
                $CategoryUpdate = $DataRows['category'];
                $ImageUpdate=$DataRows['image'];
                $PostUpdate=$DataRows['post'];

            }

            ?>
            <form class="p-4" action="EditPost.php?id= <?php echo $SearchQueryParameter; ?>" method="post"
                enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-header">
                        <h1>Edit Post</h1>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="form-group">
                            <label for="title" class="form-label"><span class="FieldInfo">Post Title:
                                </span></label>
                            <input class="form-control" type="text" name="PostTitle" id="title"
                                placeholder="Type Title here" value="<?php echo $TitleUpdate; ?>">
                        </div>
                        <div class="form-group">
                            <span class="FieldInfo">Existing Category:</span>

                            <?php echo $CategoryUpdate;?>
                            </br>
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
                            <span class="FieldInfo">Existing Image:</span>

                            <img class="mb-1" src="/Upload" <?php echo $ImageUpdate;?> />
                            </br>
                            <div class="custom-file">
                                <input class="custom-file-input" type="File" name="image" id="ImageSelect" value="">
                                <label for="ImageSelect" class="custom-file-label">Select Image:</label>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="Post" class="form-label"><span class="FieldInfo">Post:</span>
                                <textarea class="form-control" id="Post" name="PostDescription" rows="8" cols="80">
                                    <?php echo $PostUpdate;?>
                                    </textarea>
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
require_once(INCLUDES_PATH . "/footer.php")
?>