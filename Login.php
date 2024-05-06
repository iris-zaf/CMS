<?php
require_once("./resources/config.php")
?>
<!DOCTYPE html>
<html lang="en-us">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/styles.css">
</head>

<body>
    <!-- navbar -->
    <div style="height:10px; background-color:#27aae1;"></div>

    <div style="height:10px; background-color:#27aae1;"></div>
    <!-- header -->
    <header class="bg-dark text-white py-3 ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="navbar-brand">IRIS_KALOGIROU.COM</a>
                </div>
            </div>

        </div>
    </header>

    <!-- main area -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
                <div class="card bg-secondary text-light">
                    <div class="card-header bg-info text-white">
                        <h4>Welcome back!</h4>
                    </div>
                    <div class="card-body bg-dark">
                        <form class="" action="Login.php" method="post">
                            <div class="form-group">
                                <label for="username"><span class="FieldInfo">Username:</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-white bg-info">
                                            <i class="fas fa-user" style="font-size: 2rem;"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="username" id="username" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password"><span class="FieldInfo">Password:</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-white bg-info">
                                            <i class="fas fa-lock" style="font-size: 2rem;"></i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" name="password" id="password" value="">
                                </div>
                            </div>
                            <input type="submit" name="Submit" class="btn btn-info btn-block mt-3 border-0"
                                value="Login">
                        </form>
                    </div>
                </div>
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