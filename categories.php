<?php
require_once("./resources/config.php");
require_once("Includes/DB.php");
require_once("Includes/Function.php");
require_once("Includes/Session.php");
?>
<?php
if(isset($_POST["Submit"])){
$Category= $_POST["CategoryTitle"];
$Admin ="Iris";
date_default_timezone_set("Europe/Athens");
$CurrentTime=time();
echo $DateTime=strftime("%Y-%m-%H:%M:%S" ,$CurrentTime);
if(empty($Category)){
    $_SESSION["ErrorMessage"]= "Please Enter Category Title";
    Redirect_to("categories.php");

}elseif(strlen(trim($Category))<3){
    $_SESSION["ErrorMessage"]= "Category title should be at least 3 characters";
    Redirect_to("categories.php");
}
elseif(strlen(trim($Category))>49){
    $_SESSION["ErrorMessage"]= "Category title should be less than 50 characters";
    Redirect_to("categories.php");
}else{
    //Query to insert category in DB 
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
    <div class="container"><i class="fas fa-edit"></i>Manage Categories</div>
    <!-- main categories -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="col-lg-10 offset-lg-1" style="min-height:400px;">
                <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
                <form class="p-4" action="Categories.php" method="post">
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header">
                            <h1>Add New Category</h1>
                        </div>
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <label for="title" class="form-label"><span class="FieldInfo">Category Title:
                                    </span></label>
                                <input class="form-control" type="text" name="CategoryTitle" id="title"
                                    placeholder="Type Title here" value="" </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mt-2">
                                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i
                                            class="fas fa-arrow-left"></i> Back
                                        To DashBoard</a>
                                </div>
                                <div class="col-lg-6 mt-2 ">
                                    <button type="submit" name="Submit" class="btn btn-success btn-block"><i
                                            class="fas fa-check"></i> Publish</button>
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