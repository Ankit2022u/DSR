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
$total_users = count_users();
$data = get_user_uploads($_SESSION['user-data']['user_id']);

?>

<header>
    <!-- place navbar here -->
    <?php include('user_header.php'); ?>
</header>

<main>
    <div class="row">
        <div class="side-bar col-md-3 col-sm-5">
            <?php //include('side-bar.php'); 
            ?>
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
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
                        <a class="nav-link active" href="edit.php">
                            Edit
                        </a>
                    </li>

                    <li>
                        <a class="nav-link link-dark" href="feedback.php">
                            Feedback
                        </a>
                    </li>

                    <li>
                        <a href="profile.php" class="nav-link link-dark">
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
                    <img src="../uploads/<?= $_SESSION['user-data']['user_type']; ?>/<?= $_SESSION['user-data']['profile_photo_path']; ?>" alt="Profile Pic" width="32" height="32" class="rounded-circle me-2">
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
                                <h4>Uploaded Data | Editing Panel</h4>
                                <?php
                                if (isset($_SESSION['message'])) {
                                    $type = htmlspecialchars($_SESSION['type'], ENT_QUOTES, 'UTF-8');
                                    $message = htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8');
                                ?>
                                    <div class="alert alert-<?= $type; ?> alert-dismissible fade show" role="alert">
                                        <strong>Information: </strong>
                                        <?= $message; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php
                                    unset($_SESSION['message']);
                                }
                                ?>

                            </div>
                            <div class="card-body">
                                <div class="table-container" style="width:auto; overflow: scroll;">

                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                            <tr>
                                                <th>Serial Number</th>
                                                <th>Table Name</th>
                                                <th>Dead Body/Crime Number</th>
                                                <th>Creation Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <!-- <pre> -->
                                        <?php
                                        // print_r($data);
                                        $i = 1;
                                        foreach ($data as $table_array) {
                                            if (!(empty($table_array))) { ?>
                                                <tbody>
                                                    <td>
                                                        <?= $i++; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (isset($table_array['dbid'])) {
                                                            echo "Deadbody";
                                                        } else if (isset($table_array['mcid'])) {
                                                            echo "Minor Crime";
                                                        } else if (isset($table_array['cid'])) {
                                                            echo "Major Crime";
                                                        } else if (isset($table_array['ocid'])) {
                                                            echo "Ongoing Case";
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php

                                                        if (isset($table_array['dbid'])) {
                                                            echo $table_array['dead_body_number'];
                                                        } else if (isset($table_array['mcid'])) {
                                                            echo $table_array['crime_number'];
                                                        } else if (isset($table_array['cid'])) {
                                                            echo $table_array['crime_number'];
                                                        } else if (isset($table_array['ocid'])) {
                                                            echo $table_array['crime_number'];
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if (isset($table_array['dbid']) or isset($table_array['mcid']) or isset($table_array['cid']) or isset($table_array['ocid'])) {
                                                            echo $table_array['created_at'];
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php
                                                                    if (isset($table_array['dbid'])) {
                                                                        echo "deadbodyupdate.php?dbid=" . $table_array['dbid'];
                                                                    } else if (isset($table_array['mcid'])) {
                                                                        echo "minorcrimeupdate.php?mcid=" . $table_array['mcid'];
                                                                    } else if (isset($table_array['cid'])) {
                                                                        echo "majorcrimeupdate.php?cid=" . $table_array['cid'];
                                                                    } else if (isset($table_array['ocid'])) {
                                                                        echo "ongoingcaseupdate.php?ocid=" . $table_array['ocid'];
                                                                    } ?>" class="btn btn-primary">Edit</a>
                                                    </td>
                                                </tbody>
                                        <?php }
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>


<!-- place footer here -->
<?php include('../footer.php'); ?>

</body>

</html>