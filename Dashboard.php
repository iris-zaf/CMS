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
$title='All Posts';
require_once(INCLUDES_PATH . "/navbar.php")
?>
<div style="height:10px; background-color:#27aae1;"></div>
<!-- header -->
<header class="bg-dark text-white ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 p-4">
                <h1><i class="fas fa-cog" style="color:#27aae1;"></i> Dashboard</h1>
            </div>
            <div class="col-lg-3 col-md-6 mb-2">
                <a href="addNewPost.php" class="btn btn-primary btn-block">
                    <i class="fas fa-edit"></i>Add New Post</a>

            </div>
            <div class="col-lg-3 col-md-6 pb-2">
                <a href="categories.php" class="btn btn-info btn-block">
                    <i class="fas fa-folder-plus"></i>Add New Category</a>

            </div>
            <div class="col-lg-3 col-md-6 pb-2">
                <a href="admin.php" class="btn btn-warning btn-block">
                    <i class="fas fa-user-plus"></i>Add New Admin</a>

            </div>
            <div class="col-lg-3 col-md-6 pb-2">
                <a href="Comments.php" class="btn btn-success btn-block">
                    <i class="fas fa-check"></i>Approve Comments</a>

            </div>
        </div>

    </div>
</header>
<!-- MAIN AREA -->
<section class="container py-2 mb-4">
    <div class="row"> <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
        <!-- left area side -->
        <div class="col-lg-2 d-none d-md-block">
            <div class="card text-center bg-dark text-white mb-3">
                <div class="card-body">
                    <h1 class="lead">Posts</h1>
                    <h4 class="display-5">
                        <i class="fab fa-readme"></i>
                        <?php 
                        TotalPosts();
                        ?>
                    </h4>
                </div>
            </div>
            <div class="card text-center bg-dark text-white mb-3">
                <div class="card-body">
                    <h1 class="lead">Categories</h1>
                    <h4 class="display-5">
                        <i class="fas fa-folder"></i>
                        <?php
                      TotalCategories();
                        ?>
                    </h4>
                </div>
            </div>
            <div class="card text-center bg-dark text-white mb-3">
                <div class="card-body">
                    <h1 class="lead">Admins</h1>
                    <h4 class="display-5">
                        <i class="fas fa-users"></i>
                        <?php TotalAdmins();
                        
                        ?>
                    </h4>
                </div>
            </div>
            <div class="card text-center bg-dark text-white mb-3">
                <div class="card-body">
                    <h1 class="lead">Comments</h1>
                    <h4 class="display-5">
                        <i class="fas fa-comments"></i>
                        <?php
                       TotalComments();
                        ?>
                    </h4>
                </div>
            </div>
        </div>

        <!-- right area side -->
        <di class="col-lg-10">
            <h1>Top Posts</h1>
            <table class="table table-striped table-hover">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Date&Time</th>
                        <th>Author</th>
                        <th>Comments</th>
                        <th>Details</th>

                    </tr>
                </thead>
                <?php
                $SrNo =0;
                global $ConnectingDB;
                $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
                $stmt=$ConnectingDB->query($sql);
                while($DataRows=$stmt->fetch()){
                    $PostID=$DataRows['id'];
                    $DateTime=$DataRows['datetime'];
                    $Author=$DataRows['author'];
                    $Title=$DataRows['title'];
                $SrNo++;

                ?>
                <tbody>
                    <tr>
                        <td><?php echo $SrNo;?></td>
                        <td><?php echo $Title;?></td>
                        <td><?php echo $DateTime;?></td>
                        <td><?php echo $Author;?></td>
                        <td><span class="badge bg-success">
                                <?php 
                                global $ConnectingDB;
                                $sqlApprove= "SELECT COUNT(*) FROM comments WHERE post_id='$PostID' AND status='ON'";
                                $stmtApprove =$ConnectingDB->query($sqlApprove);
                                $RowTotal= $stmtApprove->fetch();
                                $Total= array_shift($RowTotal);
                                echo $Total;
                                ?>
                            </span>
                            <span class="badge bg-danger">
                                00
                            </span>
                        </td>
                        <td><a target="_blank" href="FullPost.php?id=<?php echo $PostID ?>">
                                <span class="btn btn-info">Preview</span></a></td>
                    </tr>
                </tbody>
                <?php }?>
            </table>
    </div>
    </div>
</section>


<!-- footer -->
<?php
require_once(INCLUDES_PATH . "/footer.php")
?>