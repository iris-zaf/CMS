<?php
require_once("./resources/config.php");
require_once("./Includes/Function.php");
require_once("./Includes/Session.php");
require_once("./Includes/DB.php");?>
<?php 
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login();?>
<!DOCTYPE html>
<html lang="en-us">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/styles.css">
</head>

<body>
    <!-- navbar -->

    <?php
require_once(INCLUDES_PATH . "/navbar.php")
?>
    <div style="height:10px; background-color:#27aae1;"></div>
    <!-- header -->
    <header class="bg-dark text-white ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fas fa-comments" style="color:#27aae1;"></i>Manage Comments </h1>
                </div>
            </div>
        </div>
    </header>

    <!-- main section -->
    <section class="container py-2 mb-4">
        <div class="row" style="min-height:30px;">
            <div class="col-lg-12" style="min-height:400px;">
                <h2 class="mb-4">Un-Approved Comments</h2>
                <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>No. </th>
                                <th>Date&Time</th>
                                <th>Name</th>
                                <th>Comment</th>
                                <th>Approve</th>
                                <th>Action</th>
                                <th>Details</th>
                            </tr>

                        </thead>
                        <?php 
                                global $ConnectingDB;
                                $sql="SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
                                $Execute=$ConnectingDB->query($sql);
                                $SrNo=0;
                                while($DataRows=$Execute->fetch()){
                                    $CommentId= $DataRows["id"];
                                    $DateTimeComment =$DataRows["datetime"];
                                    $CommenterName =$DataRows["name"];
                                    $CommentContent =$DataRows["comment"];
                                    $CommentPostId =$DataRows["post_id"];
                                    $SrNo++;
                        ?>
                        <tbody>
                            <td><?php echo htmlentities($SrNo);?></td>
                            <td><?php echo htmlentities($DateTimeComment);?></td>
                            <td><?php echo htmlentities($CommenterName);?></td>
                            <td><?php echo htmlentities($CommentContent);?></td>
                            <td><a href="approveComment.php?id=<?php echo $CommentId; ?>"
                                    class="btn btn-success">Approve</a></td>
                            <td><a href="deleteComment.php?id=<?php echo $CommentId; ?>"
                                    class="btn btn-danger">Delete</a></td>
                            <td><a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostId; ?>"
                                    target="_blank">Live
                                    Preview</a></td>

                            <?php }?>
                        </tbody>
                    </table>
                </div>

                <h2 class="mb-4">Approved Comments</h2>
                <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>No. </th>
                                <th>Date&Time</th>
                                <th>Name</th>
                                <th>Comment</th>
                                <th>Disapprove</th>
                                <th>Action</th>
                                <th>Details</th>
                            </tr>

                        </thead>
                        <?php 
                                global $ConnectingDB;
                                $sql="SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
                                $Execute=$ConnectingDB->query($sql);
                                $SrNo=0;
                                while($DataRows=$Execute->fetch()){
                                    $CommentId= $DataRows["id"];
                                    $DateTimeComment =$DataRows["datetime"];
                                    $CommenterName =$DataRows["name"];
                                    $CommentContent =$DataRows["comment"];
                                    $CommentPostId =$DataRows["post_id"];
                                    $SrNo++;
                        ?>
                        <tbody>
                            <td><?php echo htmlentities($SrNo);?></td>
                            <td><?php echo htmlentities($DateTimeComment);?></td>
                            <td><?php echo htmlentities($CommenterName);?></td>
                            <td><?php echo htmlentities($CommentContent);?></td>
                            <td><a href="disapproveComment.php?id=<?php echo $CommentId; ?>"
                                    class="btn btn-warning">Disapprove</a></td>
                            <td><a href="deleteComment.php?id=<?php echo $CommentId; ?>"
                                    class="btn btn-danger">Delete</a></td>
                            <td><a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostId; ?>"
                                    target="_blank">Live
                                    Preview</a></td>

                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <!-- footer -->
    <?php
require_once(INCLUDES_PATH . "/footer.php")
?>