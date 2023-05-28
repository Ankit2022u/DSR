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

            $query = "UPDATE users SET officer_name = '$officer_name', officer_rank = '$officer_rank', user_id = '$user_id', user_type = '$user_type', district = '$district', police_station = '$police_station', password = '$password', updated_at = '$updated_at'  WHERE uid = '$uid'";

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

<!-- place navbar here -->
<?php include('admin_header.php'); ?>
<main>
    <div class="row">
        <?php
        // Define the active page variable based on the current page
        $active_page = basename($_SERVER['PHP_SELF'], ".php");
        // Include the side-bar.php file
        include 'side-bar.php';
        ?>

        <div class="main-content col-md-9 col-sm-7">
            <div class="container p-1">

                <?php
                if (isset($_SESSION['message'])) :
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
                                    $uid = $_GET['uid'];
                                    $stmt = mysqli_prepare($con, "SELECT * FROM users WHERE uid=?");
                                    mysqli_stmt_bind_param($stmt, "s", $uid);
                                    mysqli_stmt_execute($stmt);
                                    $query_run = mysqli_stmt_get_result($stmt);
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
                                                <select class="form-select form-select-lg" name="user_type"
                                                    id="user_type" value="<?= $user['user_type']; ?>" required>
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
                                                <select class="form-select" name="district" id="district"
                                                    onchange="update_police_stations()" required>
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
                                        <input type="hidden" id="pshidden" value="<?= $user['police_station']; ?>">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Police Station</label>
                                                <select class="form-select" name="police_station" id="police_station"
                                                    required>

                                                    <option value="" id="optstart"></option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="">Password</label>
                                                <input type="text" name="password" class="form-control"
                                                    value="< $user['password']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="">Confirm Password</label>
                                                <input type="text" name="confirm_password" class="form-control"
                                                    value="< $user['password']; ?>" >
                                            </div>
                                        </div>
                                    </div> -->

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
<script src="../assets/js/police_station.js"></script>
<script>
function setPoliceStationValue() {
    // Get the hidden input element
    var pshidden = document.getElementById('pshidden');
    var optstart = document.getElementById('optstart');

    // Get the select element
    var policeStationSelect = document.getElementById('police_station');

    // Get the value from the hidden input
    var selectedPoliceStation = pshidden.value;

    // Setting original value
    optstart.innerText = selectedPoliceStation;
    optstart.value = selectedPoliceStation;

    // Loop through each option in the select element
    for (var i = 0; i < policeStationSelect.options.length; i++) {
        // Check if the option's value matches the selected value
        if (policeStationSelect.options[i].value === selectedPoliceStation) {
            // Set the 'selected' attribute for the matching option
            policeStationSelect.options[i].selected = true;
            break; // Exit the loop after finding the match
        }
    }
}

window.onload = function() {
    setPoliceStationValue();
};
</script>

</body>

</html>