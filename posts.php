<?php
require_once("./resources/config.php");
require_once("./Includes/Function.php");
require_once("./Includes/Session.php");
require_once("./Includes/DB.php");
?>

<!DOCTYPE html>
<html lang="en-us">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/styles.css">
</head>

<body>
    <!-- navbar -->
    <div style="height:10px; background-color:#27aae1;"></div>
    <?php
require_once(TEMPLATES_PATH . "/navbar.php")
?>
    <div style="height:10px; background-color:#27aae1;"></div>
    <!-- header -->
    <header class="bg-dark text-white ">
        <div class="container">
            <div class="row">
                <div class="col-md-12 p-4">
                    <h1><i class="fas fa-blog" style="color:#27aae1;"></i> Blog Post</h1>
                </div>
                <div class="col-lg-3 col-md-6 pb-2">
                    <a href="addNewPost.php" class="btn btn-primary btn-block">
                        <i class="fas fa-edit"></i>Add New Post</a>

                </div>
                <div class="col-lg-3 col-md-6 pb-2">
                    <a href="categories.php" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plus"></i>Add New Category</a>

                </div>
                <div class="col-lg-3 col-md-6 pb-2">
                    <a href="Admins.php" class="btn btn-warning btn-block">
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
        <div class="row">
            <div class="col-lg-12">
                <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date & Time</th>
                            <th>Author</th>
                            <th>Banner</th>
                            <th>Comments</th>
                            <th>Action</th>
                            <th>Live Preview</th>
                        </tr>
                    </thead>
                    <?php
                    global $ConnectingDB;
                    $sql= "SELECT * FROM posts";
                    $stmt= $ConnectingDB->query($sql);
                    $Sr=0;
                    while($DataRows=$stmt->fetch()){
                    $Id = $DataRows["id"];
                    $DateTime = $DataRows["datetime"];
                    $PostTitle = $DataRows["title"];
                    $Category = $DataRows["category"];
                    $Admin = $DataRows["author"];
                    $Image = $DataRows["image"];
                    $PostText = $DataRows["post"];
                    $Sr++;
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $Sr; ?></td>
                            <td>
                                <?php if(strlen($PostTitle)>20){$PostTitle = substr($PostTitle,0,18).'..';}
                                 echo $PostTitle; ?></td>
                            <td>

                                <?php if(strlen($Category)>8){$Category = substr($Category,0,8).'..';}
                            echo $Category; ?></td>
                            <td>
                                <!-- alternative way to truncate the text -->
                                <span class="d-inline-block text-truncate" style="max-width: 100px;">
                                    <?php echo $DateTime; ?>
                                </span>
                            </td>

                            <td>
                                <?php if(strlen($Admin)>20){$Admin = substr($Admin,0,18).'..';}    
                             echo $Admin; ?></td>
                            <td><img src="Upload/<?php echo $Image; ?>" width="170px; height=50px"></td>
                            <td>Comments</td>
                            <td>
                                <a href="EditPost.php?id=<?php echo $Id; ?>"><span
                                        class="btn btn-warning">Edit</span></a>
                                <a href="DeletePost.php?id=<?php echo $Id; ?>"><span
                                        class="btn btn-danger">Delete</span></a>
                            </td>
                            <td>
                                <a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span
                                        class="btn btn-primary">Live
                                        Preview</span></a>

                            </td>

                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
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