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
                            <button type="button" class="btn btn-primary" name="SearchButton">Go</button>
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
            global $ConnectingDB;
            $sql = "SELECT * FROM posts";
            $stmt= $ConnectingDB->query($sql);
            while($DataRows=$stmt->fetch()){
            $PostId= $DataRows["id"];
            $DateTime= $DataRows['datetime']; 
            $PostTitle= $DataRows['title'];
            $Category= $DataRows['category'];
            $Admin= $DataRows['author'];
            $Image= $DataRows['image'];
            $PostDescription= $DataRows['post'];
            }
            
            ?>
            <div class="card">
                <img src="Upload/<?php echo $Image; ?>" class="img-fluid card-top" />
                <div class="card-body">
                    <h4 class="card-title"><?php  echo $PostTitle; ?></h4>
                    <small class="text-muted">Written by <?php echo $Admin ?> On <?php echo $DateTime ?></small>
                    <hr>
                    <p class="card-text">
                        <?php echo $PostDescription; ?>
                    </p>

                </div>


            </div>
            <div class=" col-sm-4" style="min-height:40px; background:green;">
            </div>
        </div>
    </div>


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