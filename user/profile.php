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
            <?php //include('side-bar.php'); ?>
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
                <!-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Daily Station Report (User Panel)</span>
                </a>
                <hr> -->
                <ul class="nav nav-pills flex-column mb-auto">

                    <li class="nav-item">
                        <a href="user.php" class="nav-link link-dark" aria-current="page">
                            User Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="dead_body_form.php" class="nav-link link-dark">
                            Dead Body
                        </a>
                    </li>

                    <li>
                        <a href="major_crime_form.php" class="nav-link link-dark">
                            Major Crime
                        </a>
                    </li>

                    <li>
                        <a href="ongoing_case_form.php" class="nav-link link-dark">
                            Ongoing Case
                        </a>
                    </li>

                    <li>
                        <a href="minor_crime_form.php" class="nav-link link-dark">
                            Minor Crime
                        </a>
                    </li>

                    <li>
                        <a class="nav-link link-dark" href="feedback.php">
                            Feedback
                        </a>
                    </li>

                    <li>
                        <a href="profile.php" class="nav-link active">
                            Profile
                        </a>
                    </li>

                    <li>
                        <a href="change_password.php" class="nav-link link-dark">
                            Change Password
                        </a>
                    </li>


                </ul>
                <hr>
                <div class="profile">
                    <img src="../uploads/<?=$_SESSION['user-data']['user_type'];?>/<?=$_SESSION['user-data']['profile_photo_path']; ?>" alt="Profile Pic" width="32"
                        height="32" class="rounded-circle me-2">
                    <strong>
                        <?= $_SESSION['user-data']['officer_name']; ?>
                    </strong>
                    <a href="../auth/logout.php" class="btn btn-outline-danger m-2" name="logout">Log Out</a>
                </div>
            </div>
        </div>

        <div class="main-content col-md-9 col-sm-7">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>User details</h4>
                            </div>
                            <?php
                            $uid = $_SESSION['user-data']['uid'];
                            $query = "SELECT * FROM users where uid = '$uid'";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $user) {
                                    ?>
                                    <div class="card-body">
                                        <!-- Start Details -->
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Officer Name:</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">
                                                                    <?= $user['officer_name']; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">User ID:</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">
                                                                    <?= $user['user_id']; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Officer Rank:</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">
                                                                    <?= $user['officer_rank']; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Assigned Police Station:</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">
                                                                    <?= $user['police_station']; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">User Type:</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">
                                                                    <?php if ($user['user_type'] == "admin") {
                                                                        echo "Administration";
                                                                    } else {
                                                                        echo "User";
                                                                    } ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <img src="../uploads/user/<?= $user['profile_photo_path']; ?>" />
                                            </div>
                                        </div>

                                        <!-- End details -->
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "No Records Found";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
</main>


<!-- place footer here -->
<?php include('../footer.php'); ?>

</body>

</html>