<?php
session_start();
require "../api/dbcon.php";
?>

<!-- place navbar here -->
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
                        <a href="admin.php" class="nav-link link-dark" aria-current="page">
                            Dashboard / डैशबोर्ड
                        </a>
                    </li>
                    <li>
                        <a href="manage_user.php" class="nav-link  link-dark">
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
                            Police Stations / थाना
                        </a>
                    </li>
                    <li>
                        <a href="profile.php" class="nav-link active">
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
                            Ongoing Case / सक्रिय मामला
                        </a>
                    </li>

                    <li>
                        <a href="cjf.php" class="nav-link link-dark">
                            Court judgement / कोर्ट का निर्णय
                        </a>
                    </li>

                    <li>
                        <a href="iaf.php" class="nav-link link-dark">
                            Important Achievements / मुख्य उपलब्धियां
                        </a>
                    </li>
                    
                    <li>
                        <a href="disposal.php" class="nav-link link-dark">
                            Disposals / निकाल 
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
                                                <img src="../uploads/admin/<?= $user['profile_photo_path']; ?>" id="profile_photo" class="img-fluid" />
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