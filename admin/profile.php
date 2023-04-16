<?php
session_start();
require "../api/dbcon.php";
?>

<header>
    <!-- place navbar here -->
    <?php include('admin_header.php'); ?>
</header>

<main>
    <div class="row">
        <div class="side-bar col-md-3 col-sm-5">
            <?php include('side-bar.php'); ?>
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
                                                <img src="../uploads/admin/<?= $user['profile_photo_path']; ?>" />
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