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
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="manage_user.php" class="nav-link link-dark">
                            Manage Users
                        </a>
                    </li>
                    <li>
                        <a href="view_logs.php" class="nav-link link-dark">
                            View Logs
                        </a>
                    </li>
                    <li>
                        <a href="view_data.php" class="nav-link link-dark">
                            View Data
                        </a>
                    </li>
                    <li>
                        <a href="change_password.php" class="nav-link link-dark">
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a href="police_station.php" class="nav-link active">
                            Police Stations
                        </a>
                    </li>
                    <li>
                        <a href="profile.php" class="nav-link link-dark">
                            View Profile
                        </a>
                    </li>
                    <li>
                        <a href="dbf.php" class="nav-link link-dark">
                            Dead Body Form
                        </a>
                    </li>
                    <li>
                        <a href="mcf.php" class="nav-link link-dark">
                            Major Crime Form
                        </a>
                    </li>
                    <li>
                        <a href="micf.php" class="nav-link link-dark">
                            Minor Crime Form
                        </a>
                    </li>
                    <li>
                        <a href="ocf.php" class="nav-link link-dark">
                            Ongoing Case Form
                        </a>
                    </li>
                    <li>
                        <a href="imp_action.php" class="nav-link link-dark">
                            Important Actions
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
            <div class="container d-flex flex-column">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <?php
                        if (isset($_SESSION['message']) && isset($_SESSION['type'])) {
                            $type = htmlspecialchars($_SESSION['type'], ENT_QUOTES, 'UTF-8'); // Sanitize the 'type' value
                            $message = htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8'); // Sanitize the 'message' value
                        ?>
                            <div class="alert alert-<?= $type; ?> alert-dismissible fade show" role="alert">
                                <strong>Hey!</strong>
                                <?= $message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            unset($_SESSION['message']);
                            unset($_SESSION['type']);
                        }
                        ?>

                        <form action="../api/form_submissions.php" method="post">
                            <div class="mb-3 mt-5">
                                <div class="mb-3">

                                    <label for="district" class="form-label">District</label>
                                    <span class="required-star">*</span>
                                    <input type="text" id="district" class="form-control" name="district" placeholder="Enter District" required>
                                </div>
                                <div class="mb-3">

                                    <label for="sub_division" class="form-label">Sub Division</label>
                                    <span class="required-star">*</span>
                                    <input type="text" id="sub_division" class="form-control" name="sub_division" placeholder="Enter Sub Division" required>

                                </div>
                                <div class="mb-3">

                                    <label for="police_station" class="form-label">Police Station</label>
                                    <span class="required-star">*</span>
                                    <input type="text" id="police_station" class="form-control" name="police_station" placeholder="Enter Police Station" required>
                                </div>

                                <div class="mb-3 d-grid">
                                    <button type="submit" class="btn btn-primary" name="add_police_station">
                                        Add Police Station
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>

<!-- place footer here -->
<?php include('../footer.php'); ?>

</body>

</html>