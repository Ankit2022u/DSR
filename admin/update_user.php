<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";

$police_stations = police_stations();

if (isset($_POST['update_user'])) {

    $officer_name = mysqli_real_escape_string($con, $_POST['officer_name']);
    $officer_rank = mysqli_real_escape_string($con, $_POST['officer_rank']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
    $uid = mysqli_real_escape_string($con, $_POST['uid']);
    $updated_at = date('Y-m-d H:i:s', time());
    // Validate input fields
    $errors = array();
    if (empty($officer_name)) {
        $errors[] = "Officer name is required.";
    }
    if (empty($officer_rank)) {
        $errors[] = "Officer rank is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }
    if ($password != $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    // Minimum password length of 8 characters
    if (strlen($password) < 8) {
        $error[] = "Password must be at least 8 characters long.";
    }

    // Maximum password length of 20 characters
    if (strlen($password) > 20) {
        $error[] = "Password cannot be longer than 20 characters.";
    }

    // Password must contain at least one uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
        $error[] = "Password must contain at least one uppercase letter.";
    }

    // Password must contain at least one lowercase letter
    if (!preg_match('/[a-z]/', $password)) {
        $error[] = "Password must contain at least one lowercase letter.";
    }

    // Password must contain at least one number
    if (!preg_match('/[0-9]/', $password)) {
        $error[] = "Password must contain at least one number.";
    }

    // Password must contain at least one special character
    if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)) {
        $error[] = "Password must contain at least one special character.";
    }

    if (empty($errors)) {

        if ($password == $confirm_password) {

            $query = "UPDATE users SET officer_name = '$officer_name', officer_rank = '$officer_rank', user_id = '$user_id', user_type = '$user_type', district = '$district', status = 0, police_station = '$police_station', password = '$password', updated_at = '$updated_at'  WHERE uid = '$uid'";

            $query_run = mysqli_query($con, $query);

            if ($query_run) {

                $user = $_SESSION['user-data']['user_id'];
                $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1,'$user','users','$uid','update', 'User Data Updated.')";
                $log_query_run = mysqli_query($con, $log_query);

                $_SESSION['message'] = "User updated successfully";
                $_SESSION['type'] = "success";
                header("Location: manage_user.php");
                exit(0);
            } else {
                $_SESSION['message'] = "User creation failed due to some error.";
                $_SESSION['type'] = "danger";
                header("Location: manage_user.php");
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Password does not match.";
            $_SESSION['type'] = "danger";
            header("Location: manage_user.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";
        header("Location: manage_user.php");
        exit(0);
    }
}
?>

<header>
    <!-- place navbar here -->
    <?php include('admin_header.php'); ?>
</header>
<main>
    <div class="row">
        <div class="side-bar col-md-3 col-sm-5">
            <?php //include('side-bar.php'); ?>
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
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
                        <a href="manage_user.php" class="nav-link active">
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

                </ul>
                <hr>
                <div class="profile">
                    <img src="../uploads/<?= $_SESSION['user-data']['user_type']; ?>/<?= $_SESSION['user-data']['profile_photo_path']; ?>"
                        alt="Profile Pic" width="32" height="32" class="rounded-circle me-2">
                    <strong>
                        <?= $_SESSION['user-data']['officer_name']; ?>
                    </strong>
                    <a href="../auth/logout.php" class="btn btn-outline-danger m-2" name="logout">Log Out</a>
                </div>
            </div>
        </div>

        <div class="main-content col-md-9 col-sm-7">
            <div class="container p-1">

                <?php
                if (isset($_SESSION['message'])):
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hye!</strong>
                        <?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['message']);
                endif;
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-header">
                                <h1>Add User</h1>
                                <a href="manage_user.php" class="btn btn-danger float-end">BACK</a>
                            </div>

                            <div class="card-body">
                                <?php if (isset($_GET['uid'])) {
                                    $uid = mysqli_real_escape_string($con, $_GET['uid']);
                                    $query = "SELECT * FROM users WHERE uid='$uid'";
                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        $user = mysqli_fetch_array($query_run);
                                        ?>


                                        <form action="update_user.php" method="POST">
                                            <input type="hidden" name="uid" value="<?= $user['uid']; ?>">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="">Officer Name</label>
                                                        <input type="text" name="officer_name" class="form-control"
                                                            value="<?= $user['officer_name']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="">Officer Rank</label>
                                                        <input type="text" name="officer_rank" class="form-control"
                                                            value="<?= $user['officer_rank']; ?>" required>
                                                    </div>
                                                </div>

                                            </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="">User ID</label>
                                            <input type="text" name="user_id" class="form-control"
                                                value="<?= $user['user_id']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="">User Type</label>
                                            <select class="form-select form-select-lg" name="user_type" id="user_type"
                                                value="<?= $user['user_type']; ?>" required>
                                                <option <?php if ($user['user_type'] == "user") {

                                                    echo 'selected';
                                                } ?> value="user">User</option>
                                                <option <?php if ($user['user_type'] == "admin") {
                                                    echo 'selected';
                                                } ?> value="admin">Administration</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="district" class="form-label">District</label>
                                            <select class="form-select form-select-lg" name="district" id="district" required>
                                                <option value="Surguja" <?php if ($user['district'] == "Surguja") {

                                                    echo 'selected';
                                                } ?>>Surguja</option>
                                                <option value="Balrampur" <?php if ($user['district'] == "Balrampur") {
                                                    echo 'selected';
                                                } ?>>Balrampur</option>
                                                <option value="Surajpur" <?php if ($user['district'] == "Surajpur") {
                                                    echo 'selected';
                                                } ?>>Surajpur</option>
                                                <option value="Jashpur" <?php if ($user['district'] == "Jashpur") {
                                                    echo 'selected';
                                                } ?>>Jashpur</option>
                                                <option value="Manendragarh-Chirmiri-Bharatpur" <?php if ($user['district'] == "Manendragarh-Chirmiri-Bharatpur") {
                                                    echo 'selected';
                                                } ?>>
                                                    Manendragarh-Chirmiri-Bharatpur
                                                </option>
                                                <option value="Korea" <?php if ($user['district'] == "Korea") {
                                                    echo 'selected';
                                                } ?>>Korea</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Police Station</label>
                                            <select class="form-select form-select-lg" name="police_station" id="police_station"
                                                value="<?= $user['police_station']; ?>" required>
                                                <?php foreach ($police_stations as $option) {
                                                    ?><option value="<?= $option['police_station']; ?>"><?= $option['police_station']; ?></option>
                                                    <?php
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="">Password</label>
                                            <input type="text" name="password" class="form-control"
                                                value="<?= $user['password']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="">Confirm Password</label>
                                            <input type="text" name="confirm_password" class="form-control"
                                                value="<?= $user['password']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <button class="btn btn-primary" type="submit" name="update_user">Save
                                                User
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                </form>
                                <?php
                                    }
                                } ?>
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