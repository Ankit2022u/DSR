<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";

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
                                    <div class="col-md-6 col-sm-12">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <p class="mb-0">Officer Name:</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="text-muted mb-0">
                                                            <?= $user['officer_name']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <p class="mb-0">User ID:</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="text-muted mb-0">
                                                            <?= $user['user_id']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <p class="mb-0">Officer Rank:</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="text-muted mb-0">
                                                            <?= $user['officer_rank']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <p class="mb-0">Assigned Police Station:</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="text-muted mb-0">
                                                            <?= $user['police_station']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <p class="mb-0">User Type:</p>
                                                    </div>
                                                    <div class="col-md-9">
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
                                    <div class="col-md-6 col-sm-12">
                                        <img src="../uploads/user/<?= $user['profile_photo_path']; ?>"
                                            id="profile_photo" class="img-fluid" />
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
        </div>
    </div>
</main>


<!-- place footer here -->
<?php include('../footer.php'); ?>

</body>

</html>