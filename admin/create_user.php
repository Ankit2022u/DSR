<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";

if (isset($_POST['save_user'])) {

    $officer_name = mysqli_real_escape_string($con, $_POST['officer_name']);
    $officer_rank = mysqli_real_escape_string($con, $_POST['officer_rank']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    $file = $_FILES['profile_photo'];
    $profile_photo_path = $file['name'];
    move_uploaded_file($file['tmp_name'], "../uploads/" . $user_type . "/" . $profile_photo_path);

    // Validate input fields
    $errors = array();
    if (empty($officer_name)) {
        $errors[] = "Officer name is required.";
    }
    if (empty($officer_rank)) {
        $errors[] = "Officer rank is required.";
    }
    if (empty($user_id)) {
        $errors[] = "User ID is required.";
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
            $query = "INSERT INTO users(officer_name, officer_rank, user_id, user_type, district, status, police_station, password, profile_photo_path) VALUES (?, ?, ?, ?, ?, 0, ?, ?, ?)";

            try {
                $stmt = mysqli_prepare($con, $query);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ssssssss", $officer_name, $officer_rank, $user_id, $user_type, $district, $police_station, $hashed_password, $profile_photo_path);
                mysqli_stmt_execute($stmt);

                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    $inserted_id = mysqli_insert_id($con);
                    $user = $_SESSION['user-data']['user_id'];
                    $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1, ?, 'users', ?, 'insert', 'User Created.')";
                    $log_stmt = mysqli_prepare($con, $log_query);
                    mysqli_stmt_bind_param($log_stmt, "ss", $user, $inserted_id);
                    mysqli_stmt_execute($log_stmt);

                    $_SESSION['message'] = "User created successfully";
                    $_SESSION['type'] = "success";
                    header("Location: create_user.php");
                    exit;
                } else {
                    $_SESSION['message'] = "User creation failed due to some error.";
                    $_SESSION['type'] = "danger";
                    header("Location: create_user.php");
                    exit;
                }
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() === 1062) {
                    $_SESSION['message'] = "User already exists. Try a different user ID.";
                    $_SESSION['type'] = "danger";
                    header("Location: create_user.php");
                    exit;
                }
            }
        } else {
            $_SESSION['message'] = "Password does not match.";
            $_SESSION['type'] = "danger";
            header("Location: create_user.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";
    }

}

$police_stations = police_stations();

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
                            Dashboard / डैशबोर्ड
                        </a>
                    </li>
                    <li>
                        <a href="manage_user.php" class="nav-link active">
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
                if (isset($_SESSION['message'])) {
                    ?>
                    <div class="alert alert-<?= $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                        <strong>Hye!</strong>
                        <?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['message']);
                }
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-header">
                                <h1>Add User</h1>
                                <a href="manage_user.php" class="btn btn-danger float-end">BACK</a>
                            </div>

                            <div class="card-body">
                                <form action="create_user.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="">Officer Name</label>
                                                <span class="required-star">*</span>
                                                <input type="text" name="officer_name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="">Officer Rank</label>
                                                <span class="required-star">*</span>
                                                <input type="text" name="officer_rank" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="">User ID</label>
                                                <span class="required-star">*</span>
                                                <input type="text" name="user_id" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="">User Type</label>
                                                <span class="required-star">*</span>

                                                <select class="form-select form-select-lg" name="user_type"
                                                    id="user_type" required>
                                                    <option selected value="user">User</option>
                                                    <option value="admin">Administration</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">


                                                <label for="district">District / जिला<span
                                                        class="required-star">*</span></label>
                                                <select class="form-select" name="district" id="district"
                                                    onchange="update_police_stations()" required>
                                                    <option value="">Select Option</option>
                                                    <option value="सरगुजा">सरगुजा</option>
                                                    <option value="बलरामपुर">बलरामपुर</option>
                                                    <option value="सूरजपुर">सूरजपुर</option>
                                                    <option value="मनेंद्रगढ़-चिरमीरी-भरतपुर">मनेंद्रगढ़-चिरमीरी-भरतपुर
                                                    </option>
                                                    <option value="जशपुर">जशपुर</option>
                                                    <option value="कोरिया">कोरिया</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Police Station</label>
                                                <span class="required-star">*</span>
                                                <select class="form-select form-select-lg" name="police_station"
                                                    id="police_station" required>

                                                    <option value="">Select Option</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="">Profile Photo</label>
                                            <input type="file" name="profile_photo" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="">Password</label>
                                                <span class="required-star">*</span>
                                                <input type="text" name="password" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="">Confirm Password</label>
                                                <span class="required-star">*</span>
                                                <input type="text" name="confirm_password" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <button class="btn btn-primary" type="submit" name="save_user">Save User
                                                </button>
                                            </div>
                                        </div>
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


<!-- place footer here -->
<?php include('../footer.php'); ?>
<script src="../assets/js/police_station.js"></script>

</body>

</html>