<?php
require_once("./resources/config.php");
require_once("./Includes/Function.php");
require_once("./Includes/Session.php");
require_once("./Includes/DB.php");
?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];

Confirm_Login();?>

<?php
$title='All Blogs';
require_once(INCLUDES_PATH . "/navbar.php")
?>
<div style="height:10px; background-color:#27aae1;"></div>
<!-- main categories -->


<div style="height:10px; background-color:#27aae1;"></div>
<!-- header -->
<div class="container">
    <div class="row mt-4">
        <div class="col-sm-8">
            <h1>The Complete Responsive CMS Blog</h1>
            <h1 class="lead">The Complete blog using PHP by Iris Kalogirou</h1>

            <?php
                    echo ErrorMessage();
                    echo SuccessMessage();
                    ?>
            <?php 
                    global $ConnectingDB;
                    $sql = "SELECT * FROM posts ORDER BY id desc";
                     $stmt= $ConnectingDB->query($sql);
                    while($DataRows=$stmt->fetch()){
                    $PostId= $DataRows["id"];
                    $DateTime= $DataRows['datetime']; 
                    $PostTitle= $DataRows['title'];
                    $Category= $DataRows['category'];
                    $Admin= $DataRows['author'];
                    $Image= $DataRows['image'];
                    $PostDescription= $DataRows['post'];
                
                    ?>
        </div>
        <div class="blog-card">

            <div class="meta">
                <div class="photo">
                    <img src="Upload/<?php echo htmlentities($Image); ?>" style="max-height:450px;"
                        class="img-fluid card-img-top" />
                </div>
                <ul class="details">

                    <li class="author">
                        <h4 class="card-title"><?php  echo htmlentities($PostTitle); ?></h4>
                    </li>
                    <li class="author"><small>Written by <?php echo htmlentities($Admin); ?>
                    </li>
                    <li class="date"><?php echo htmlentities($DateTime); ?></small></li>
                    <span style="float:right;" class="badge bg-dark text-light">
                        Comments
                    </span>

                </ul>
            </div>
            <div class="description">
                <p class="card-text">
                    <?php 
                    if(strlen($PostDescription) > 150){
                        $PostDescription = substr($PostDescription, 0, 150) . "...";
                    } 
                    echo htmlentities($PostDescription);
                    ?>
                <p class="read-more">
                    <a href="FullPost.php?id=<?php echo $PostId;?>">Read More</a>

                </p>
            </div>
        </div>
        <?php }?>
    </div>
</div>


<!-- footer -->
<?php
require_once(INCLUDES_PATH . "/footer.php")
?>