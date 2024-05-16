<?php
require_once("./resources/config.php")
?>



<body>
    <!DOCTYPE html>
    <html lang="en-us">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $title; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="public/assets/css/styles.css">
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

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- all private links, will make posts or blog page public -->
                        <li class="nav-item">
                            <a href="blog.php" class="nav-link">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Features</a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">News</a>
                        </li>
                        <li class="nav-item">
                            <a href="Login.php" class="nav-link">Login</a>
                        </li>


                    </ul>

                </div>
            </div>
        </nav>
        <div style="height:10px; background-color:#27aae1;"></div>

        <div class="divider"></div>


        <!-- Main Content Area -->
        <div class="main-content">
            <div class="container">
                <h2>Welcome to My Blog</h2>
                <p>Have Fun exploring all the pages 🙆‍♀️</p>
                <p>Still in production, please be patient while features are being added ✨</p>
                <!-- Add your blog posts here -->
            </div>
        </div>

        <!-- Footer -->
        <?php require_once(INCLUDES_PATH . "/footer.php"); ?>

    </body>



    <!-- footer -->
    <?php
require_once(INCLUDES_PATH . "/footer.php")
?>