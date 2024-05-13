<?php
require_once("./resources/config.php");
require_once("./Includes/Function.php");
require_once("./Includes/Session.php");
require_once("./Includes/DB.php");

$SearchQueryParameter = $_GET['id'];
global $ConnectingDB;
$sql= "SELECT * FROM posts WHERE id='$SearchQueryParameter'";
$stmtPost= $ConnectingDB->query($sql);
while($DataRows=$stmtPost->fetch()){
    $TitleDeleted = $DataRows['title'];
    $CategoryDeleted = $DataRows['category'];
    $ImageDeleted=$DataRows['image'];
    $PostDeleted=$DataRows['post'];

}
if(isset($_POST["Submit"])){
global $ConnectingDB;
$sql= "DELETE FROM posts WHERE id='$SearchQueryParameter'";
    $Execute=$ConnectingDB->query($sql);
    if ($Execute) {
        $Target_Path_Delete_Image= "Upload/{$ImageDeleted}";
        unlink($Target_Path_Delete_Image);
    $_SESSION["SuccessMessage"]= "Post deleted Successfully";
    Redirect_to("posts.php");
     } else {
        $errorInfo = $ConnectingDB->errorInfo();
    $_SESSION["ErrorMessage"]= "SQL Error: " . $errorInfo[2]; // Show the detailed error message
    Redirect_to("posts.php");

     }
    
    }


?>

<?php
$title='Delete a Post';
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

            ?>
            <form class="p-4" action="DeletePost.php?id= <?php echo $SearchQueryParameter; ?>" method="post"
                enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-header">
                        <h1>Delete Post</h1>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="form-group">
                            <label for="title" class="form-label"><span class="FieldInfo">Post Title:
                                </span></label>
                            <input disabled class="form-control" type="text" name="PostTitle" id="title"
                                placeholder="Type Title here" value="<?php echo $TitleDeleted; ?>">
                        </div>
                        <div class="form-group">
                            <span class="FieldInfo">Existing Category:</span>

                            <?php echo $CategoryDeleted;?>
                            </br>
                        </div>
                        <div class="form-group">
                            <span class="FieldInfo">Existing Image:</span>

                            <img class="mb-1" src="/Upload" <?php echo $ImageDeleted;?> />
                        </div>
                        <div class="form-group mt-2">
                            <label for="Post" class="form-label"><span class="FieldInfo">Post:</span>
                                <textarea disabled class="form-control" id="Post" name="PostDescription" rows="8"
                                    cols="80">
                                    <?php echo $PostDeleted;?>
                                    </textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <a href="Dashboard.php" class="btn btn-warning btn-block"><i
                                        class="fas fa-arrow-left"></i> Back
                                    To DashBoard</a>
                            </div>
                            <div class="col-lg-6 mt-2 ">
                                <button type="submit" name="Submit" class="btn btn-danger btn-block"><i
                                        class="fas fa-trash"></i>
                                    Delete</button>
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