<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";
$police_stations = police_stations();

$total_major_crimes = count_major_crimes();
$total_dead_bodies = count_dead_bodies();
$total_minor_crimes = count_minor_crimes();
$total_ongoing_cases = count_ongoing_cases();
$total_police_stations = count_police_stations();
$total_important_achievements = count_important_achievements();
$total_court_judgments = count_court_judgements();
$total_users = count_users();

?>

<!-- place navbar here -->
<?php include('user_header.php'); ?>

<main>
    <div class="row">
        <?php
        // Define the active page variable based on the current page
        $active_page = basename($_SERVER['PHP_SELF'], ".php");
        // Include the side-bar.php file
        include 'side-bar.php';
        ?>
        <div class="main-content col-md-9 col-sm-7">
            <div class="row">
                <div class="card text-white mb-3 col-md-4 col-sm-6">
                    <div class="card-body bg-danger">
                        <h5 class="card-title">Total Crimes: </h5>
                        <p class="card-text">
                            <?= $total_major_crimes; ?>
                        </p>
                    </div>
                </div>

                <div class="card text-white mb-3 col-md-4 col-sm-6">
                    <div class="card-body bg-success">
                        <h5 class="card-title">Total Minor Crimes: </h5>
                        <p class="card-text">
                            <?= $total_minor_crimes; ?>
                        </p>
                    </div>
                </div>

                <div class="card text-white mb-3 col-md-4 col-sm-6">
                    <div class="card-body bg-primary">
                        <h5 class="card-title">Total Ongoing Cases: </h5>
                        <p class="card-text">
                            <?= $total_ongoing_cases; ?>
                        </p>
                    </div>
                </div>

                <div class="card text-white mb-3 col-md-4 col-sm-6">
                    <div class="card-body bg-dark">
                        <h5 class="card-title">Total Dead Bodies: </h5>
                        <p class="card-text">
                            <?= $total_dead_bodies; ?>
                        </p>
                    </div>
                </div>

                <div class="card text-white mb-3 col-md-4 col-sm-6">
                    <div class="card-body bg-warning">
                        <h5 class="card-title">Total Police Stations: </h5>
                        <p class="card-text">
                            <?= $total_police_stations; ?>
                        </p>
                    </div>
                </div>

                <div class="card text-white mb-3 col-md-4 col-sm-6">
                    <div class="card-body bg-info">
                        <h5 class="card-title">Total Users: </h5>
                        <p class="card-text">
                            <?= $total_users; ?>
                        </p>
                    </div>
                </div>
                <div class="card text-white mb-3 col-md-4 col-sm-12 col-xs-6">
                    <div class="card-body bg-primary">
                        <h5 class="card-title">Total Court Judgments: </h5>
                        <p class="card-text">
                            <?= $total_court_judgments; ?>
                        </p>
                    </div>
                </div>

                <div class="card text-white mb-3 col-md-4 col-sm-12 col-xs-6">
                    <div class="card-body bg-success">
                        <h5 class="card-title">Total Achievements: </h5>
                        <p class="card-text">
                            <?= $total_important_achievements; ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
</main>



<!-- place footer here -->
<?php include('../footer.php'); ?>

</body>

</html>