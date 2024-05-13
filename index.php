<?php
require_once("./resources/config.php")
?>

<?php
$title="Main Page";
require_once(INCLUDES_PATH . "/navbar.php")
?>

<body>
    <div style="height:10px; background-color:#27aae1;"></div>

    <div class="divider"></div>


    <!-- Main Content Area -->
    <div class="main-content">
        <div class="container">
            <h2>Welcome to My Blog</h2>
            <p>Have Fun exploring all the pages 🙆‍♀️</p>
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