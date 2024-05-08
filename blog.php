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

    <title>Blog Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/styles.css">
</head>

<body>
    <!-- navbar -->
    <div style="height:10px; background-color:#27aae1;"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">IRIS_KALOGIROU.COM</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapseCMS">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapseCMS">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="blog.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="blog.php" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Features</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <form class="form-inline my-2 my-lg-4" action="blog.php">
                        <div class="input-group">
                            <input class="form-control" type="text" name="Search" placeholder="Search Here" value="">
                            <button type="submit" class="btn btn-primary" name="SearchButton">Go</button>

                        </div>
                    </form>
                </ul>
            </div>
        </div>
    </nav>

    <!-- navbar end -->



    <div style="height:10px; background-color:#27aae1;"></div>
    <!-- header -->
    <div class="container">
        <div class="row mt-4">
            <div class="col-sm-8"></div>
            <h1>The Complete Responsive CMS Blog</h1>
            <h1 class="lead">The Complete blog using PHP by Iris Kalogirou</h1>
            <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
            <?php 
            global $ConnectingDB;
               if(isset( $_GET['SearchButton'])){
                 $Search = $_GET["Search"];
                 $sql ="SELECT * FROM posts 
                 WHERE datetime LIKE :search
                 OR title LIKE :search 
                 OR category LIKE :search 
                 OR post LIKE :search"; 
                 $stmt = $ConnectingDB->prepare($sql);
                 $stmt->bindValue(':search','%'.$Search.'%');
                 $stmt->execute();      
               }
           else{
            $sql = "SELECT * FROM posts ORDER BY id desc";
            $stmt= $ConnectingDB->query($sql);

           }
            while($DataRows=$stmt->fetch()){
            $PostId= $DataRows["id"];
            $DateTime= $DataRows['datetime']; 
            $PostTitle= $DataRows['title'];
            $Category= $DataRows['category'];
            $Admin= $DataRows['author'];
            $Image= $DataRows['image'];
            $PostDescription= $DataRows['post'];
           
            ?>
            <div class="card">
                <img src="Upload/<?php echo htmlentities($Image); ?>" style="max-height:450px;"
                    class="img-fluid card-img-top" />
                <div class="card-body">
                    <h4 class="card-title"><?php  echo htmlentities($PostTitle); ?></h4>
                    <small class="text-muted">Written by <?php echo htmlentities($Admin); ?> On
                        <?php echo htmlentities($DateTime); ?></small>
                    <span style="float:right;" class="badge bg-dark text-light">
                        Comments 20
                    </span>

                    <hr>
                    <p class="card-text">
                        <?php 
                    if(strlen($PostDescription) > 150){
                        $PostDescription = substr($PostDescription, 0, 150) . "...";
                    } 
                    echo htmlentities($PostDescription);
                    ?>
                    </p>
                    <a href="FullPost.php?id=<?php echo $PostId;?>" style="right">
                        <span class="btn btn-info">Read More >></span></a>
                </div>


            </div>
            <?php }?>




            <div class=" col-sm-4" style="min-height:40px; background:green;">
            </div>
        </div>
    </div>


    <!-- footer -->
    <?php
require_once(INCLUDES_PATH . "/footer.php")
?>