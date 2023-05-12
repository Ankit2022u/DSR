<?php
session_start();
require '../api/functions.php';

if (!(isset($_SESSION['user-data']))) {
    header("Location: ../index.php");
}

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
                        <a href="change_password.php" class="nav-link active">
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a href="police_station.php" class="nav-link link-dark">
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

            <div class="container d-flex flex-column">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="card shadow-sm">
                            <?php
                            if (isset($_SESSION['message']) && isset($_SESSION['type'])) {
                                $message = $_SESSION['message'];
                                $type = $_SESSION['type'];

                                // Sanitize message and type to prevent XSS attacks
                                $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
                                $type = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');

                            ?>
                                <div class="alert alert-<?= $type; ?> alert-dismissible fade show" role="alert">
                                    <span>
                                        <?= $message; ?>
                                    </span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                                unset($_SESSION['message']);
                                unset($_SESSION['type']);
                            }
                            ?>

                            <div class="card-body">
                                <form method="POST" action="../auth/change_password.php">
                                    <input type="hidden" id="user_id" class="form-control" name="user_id" value="<?= $_SESSION['user-data']['user_id']; ?>">
                                    <div class="mb-3">
                                        <label for="old_password" class="form-label">Old Password</label>
                                        <span class="required-star">*</span>
                                        <input type="password" id="old_password" class="form-control" name="old_password" placeholder="Enter Current Password" required>
                                        <span class="pass_icon" onclick="changeIcon(1)"><i id="icon1" class="bi bi-eye-fill"></i></span>

                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <span class="required-star">*</span>
                                        <input type="password" id="new_password" class="form-control" name="new_password" placeholder="Enter New Password" required>
                                        <span class="pass_icon" onclick="changeIcon(2)"><i id="icon2" class="bi bi-eye-fill"></i></span>

                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_new_password" class="form-label">Confirm New
                                            Password</label>
                                        <span class="required-star">*</span>
                                        <input type="password" id="confirm_new_password" class="form-control" name="confirm_new_password" placeholder="Confirm New Password" required>
                                        <span class="pass_icon" onclick="changeIcon(3)"><i id="icon3" class="bi bi-eye-fill"></i></span>
                                    </div>
                                    <div class="mb-3 d-grid">
                                        <button type="submit" class="btn btn-primary" name="change_password_admin">
                                            Reset Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <ul>
                                    <li>
                                        Minimum password length of 8 characters
                                    </li>
                                    <li>
                                        Minimum password length of 8 characters
                                    </li>
                                    <li>
                                        Maximum password length of 20 characters
                                    </li>
                                    <li>
                                        Password must contain at least one uppercase letter
                                    </li>
                                    <li>
                                        Password must contain at least one lowercase letter
                                    </li>
                                    <li>
                                        Password must contain at least one number
                                    </li>
                                    <li>
                                        Password must contain at least one special character
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>


<?php include('../footer.php'); ?>

</body>

</html>