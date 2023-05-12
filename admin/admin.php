<?php
session_start();
require '../api/functions.php';

if (!(isset($_SESSION['user-data']))) {
    header("Location: ../index.php");
}

$total_major_crimes = count_major_crimes();
$total_dead_bodies = count_dead_bodies();
$total_minor_crimes = count_minor_crimes();
$total_ongoing_cases = count_ongoing_cases();
$total_police_stations = count_police_stations();
$total_users = count_users();
?>

<?php include('admin_header.php'); ?>
<main>
    <div class="row">

        <div class="side-bar col-md-3 col-sm-5">
            <?php //include('side-bar.php'); 
            ?>

            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                <!-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Daily Station Report (Admin Panel)</span>
                </a>
                <hr> -->
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link active" aria-current="page">
                            Dashboard / डैशबोर्ड
                        </a>
                    </li>
                    <li>
                        <a href="manage_user.php" class="nav-link link-dark">
                            Manage Users / उपयोगकर्ताओं का प्रबंधन
                        </a>
                    </li>
                    <li>
                        <a href="view_logs.php" class="nav-link link-dark">
                            View Logs / लॉग्स को देखें
                        </a>
                    </li>
                    <li>
                        <a href="view_data.php" class="nav-link link-dark">
                            View Data / डेटा का हिसाब
                        </a>
                    </li>
                    <li>
                        <a href="change_password.php" class="nav-link link-dark">
                            Change Password / पासवर्ड को बदले
                        </a>
                    </li>
                    <li>
                        <a href="police_station.php" class="nav-link link-dark">
                            Police Station / थाना
                        </a>
                    </li>
                    <li>
                        <a href="profile.php" class="nav-link link-dark">
                            View Profile / प्रोफाइल
                        </a>
                    </li>
                    <li>
                        <a href="dbf.php" class="nav-link link-dark">
                            Inquest / मर्ग
                        </a>
                    </li>
                    <li>
                        <a href="mcf.php" class="nav-link link-dark">
                            Major Crime / गंभीर अपराध
                        </a>
                    </li>
                    <li>
                        <a href="micf.php" class="nav-link link-dark">
                            Minor Crime / सामान्य अपराध
                        </a>
                    </li>
                    <li>
                        <a href="ocf.php" class="nav-link link-dark">
                            Active Case / सक्रिय मामला
                        </a>
                    </li>
                    <li>
                        <a href="cjf.php" class="nav-link link-dark">
                            Court judgement / कोर्ट का निर्णय
                        </a>
                    </li>
                </ul>
            </div>
            <hr>
            <div class="profile">
                <img src="../uploads/<?= $_SESSION['user-data']['user_type']; ?>/<?= $_SESSION['user-data']['profile_photo_path']; ?>" alt="Profile Pic" width="32" height="32" class="rounded-circle me-2">
                <strong>
                    <?= $_SESSION['user-data']['officer_name']; ?>
                </strong>
                <a href="../auth/logout.php" class="btn btn-outline-danger m-2" name="logout">Log Out</a>
            </div>
        </div>

        <div class="main-content container col-md-9 col-sm-7">
            <div class="row">
                <div class="card text-white mb-3 col-md-4 col-sm-12 col-xs-6">
                    <div class="card-header">
                        <a href="mcf.php" class="btn btn-outline-danger add-icon"><i class="fas fa-plus-square"></i></i>
                            <span>Add major crime</span></a>
                    </div>
                    <div class="card-body bg-danger">
                        <h5 class="card-title">Total Crimes: </h5>
                        <p class="card-text">
                            <?= $total_major_crimes; ?>
                        </p>
                    </div>
                </div>

                <div class="card text-white mb-3 col-md-4 col-sm-12 col-xs-6">
                    <div class="card-header">
                        <a href="micf.php" class="btn btn-outline-success add-icon"><i class="fas fa-plus-square"></i></i>
                            <span>Add minor crime</span></a>
                    </div>
                    <div class="card-body bg-success">
                        <h5 class="card-title">Total Minor Crimes: </h5>
                        <p class="card-text">
                            <?= $total_minor_crimes; ?>
                        </p>
                    </div>
                </div>

                <div class="card text-white mb-3 col-md-4 col-sm-12 col-xs-6">
                    <div class="card-header">
                        <a href="ocf.php" class="btn btn-outline-primary add-icon"><i class="fas fa-plus-square"></i></i>
                            <span>Add ongoing case</span></a>
                    </div>
                    <div class="card-body bg-primary">
                        <h5 class="card-title">Total Ongoing Cases: </h5>
                        <p class="card-text">
                            <?= $total_ongoing_cases; ?>
                        </p>
                    </div>
                </div>

                <div class="card text-white mb-3 col-md-4 col-sm-12 col-xs-6">
                    <div class="card-header">
                        <a href="dbf.php" class="btn btn-outline-dark add-icon"><i class="fas fa-plus-square"></i></i>
                            <span>Add deadbody details</span></a>
                    </div>
                    <div class="card-body bg-dark">
                        <h5 class="card-title">Total Dead Bodies: </h5>
                        <p class="card-text">
                            <?= $total_dead_bodies; ?>
                        </p>
                    </div>
                </div>

                <div class="card text-white mb-3 col-md-4 col-sm-12 col-xs-6">
                    <div class="card-header">
                        <a href="police_station.php" class="btn btn-outline-warning add-icon"><i class="fas fa-plus-square"></i></i>
                            <span>Add police station</span></a>
                    </div>
                    <div class="card-body bg-warning">
                        <h5 class="card-title">Total Police Stations: </h5>
                        <p class="card-text">
                            <?= $total_police_stations; ?>
                        </p>
                    </div>
                </div>

                <div class="card text-white mb-3 col-md-4 col-sm-12 col-xs-6">
                    <div class="card-header">
                        <a href="create_user.php" class="btn btn-outline-info add-icon"><i class="fas fa-plus-square"></i></i>
                            <span>Add user</span></a>
                    </div>
                    <div class="card-body bg-info">
                        <h5 class="card-title">Total Users: </h5>
                        <p class="card-text">
                            <?= $total_users; ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>


<?php include('../footer.php'); ?>

</body>

</html>