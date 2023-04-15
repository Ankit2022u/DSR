<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";
$police_stations = police_stations();

?>

<header>
    <!-- place navbar here -->
    <?php include('user_header.php'); ?>
</header>

<main>
    <div class="row">
        <div class="side-bar col-md-3 col-sm-5">
            <?php include('side-bar.php'); ?>
        </div>

        <div class="main-content col-md-9 col-sm-7">
            
        </div>
</main>


<!-- place footer here -->
<?php include('../footer.php'); ?>

</body>

</html>