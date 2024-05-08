<?php
require_once("./resources/config.php");

require_once("./Includes/Function.php");
require_once("./Includes/Session.php");
require_once("./Includes/DB.php");
?>
<?php $SearchQueryParameter = $_GET["id"];?>
<?php
if(isset($_POST["Submit"])){
$Name= $_POST["CommenterField"];
$Email ="CommenterMail";
$Comment= $_POST["CommenterThoughts"];

date_default_timezone_set("Europe/Athens");
$CurrentTime=time();
$DateTime=strftime("%Y-%m-%H:%M:%S" ,$CurrentTime);

if(empty($Name)||empty($Email)||empty($Comment)){
    $_SESSION["ErrorMessage"]= "All Fields must be filled out";
    Redirect_to("FullPost.php?id={$SearchQueryParameter}");

}elseif(strlen($Comment)>500){
    $_SESSION["ErrorMessage"]= "Comment length should be less than 500 characters";
    Redirect_to("FullPost.php?id={$SearchQueryParameter}");
}else{
    //Query to insert category in DB
    $sql= "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)";
    $sql .= "VALUES(:dateTime,:name,:email,:comment,'Pending','OFF',:postIdFromUrl)";
    $stmt = $ConnectingDB->prepare($sql);

    $stmt->bindValue(':dateTime',$DateTime);
    $stmt->bindValue(':name',$Name);
    $stmt->bindValue(':email',$Email);
    $stmt->bindValue(':comment',$Comment);
    $stmt->bindValue(':postIdFromUrl',$SearchQueryParameter);

    $Execute=$stmt->execute();
    if ($Execute) {
    $_SESSION["SuccessMessage"]= "Comment Submitted Successfully";
    Redirect_to("FullPost.php?id={$SearchQueryParameter}");
     } else {
        $_SESSION["ErrorMessage"]= "Something went wrong while adding the Comment";
        Redirect_to("FullPost.php?id={$SearchQueryParameter}");

     }
    
    }
}

?>
<!DOCTYPE html>
<html lang="en-us">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="public_html/css/styles.css">
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
            $PostIdURL= $_GET["id"];
           if(!isset($PostIdURL)){
            $_SESSION["ErrorMessage"]="Bad Request";
            Redirect_to("Blog.php");

           } 
           $sql = "SELECT * FROM posts WHERE id='$PostIdURL'";
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
                        <?php echo htmlentities($PostDescription); ?>
                    </p>

                </div>


            </div>
            <?php }?>

            <!-- FETCH EXISTING COMMENTS  -->
            <div class="container mt-4">
                <h5 class="mb-3 FieldInfo">Comments</h5>

                <?php 
                global $ConnectingDB;
                $sql= "SELECT * FROM comments
                 WHERE post_id='$SearchQueryParameter'
                 AND status='ON'";
                $stmt = $ConnectingDB->query($sql);
                while ($DataRows = $stmt->fetch()){
                    $CommentDate=$DataRows['datetime'];
                    $CommentAuthor=$DataRows['name'];
                    $CommentContent=$DataRows['comment'];
                ?>
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <img class="img-fluid" src="public_html/img/user.png" alt="">
                        </div>
                        <div class="col-md-10">
                            <div class="card-header">

                                <h6 class="card-title mb-0"><?php echo $CommentAuthor; ?></h6>
                                <p class="card-text text-muted small"><?php echo $CommentDate; ?></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?php echo $CommentContent; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <div>
                <form class="" action="FullPost.php?id=<?php echo $SearchQueryParameter; ?>" method="post">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="FieldInfo">Share your post about this post</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input class="form-control" type="text" name="CommenterField" value=""
                                        placeholder="Type your comment here">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input class="form-control" type="email" name="CommenterMail" value=""
                                        placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="CommenterThoughts" class="form-control" rows="6" cols="80"></textarea>
                            </div>
                            <div>
                                <button type="submit" name="Submit" class="btn btn-primary"
                                    id="SubmitButton">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>



            <div class=" col-sm-4" style="min-height:40px; background:green;">
            </div>
        </div>
    </div>


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