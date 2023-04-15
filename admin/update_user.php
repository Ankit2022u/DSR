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

    if ($password == $confirm_password) {

        $query = "UPDATE users SET officer_name = '$officer_name', officer_rank = '$officer_rank', user_id = '$user_id', user_type = '$user_type', district = '$district', status = 0, police_station = '$police_station', password = '$password', updated_at = '$updated_at'  WHERE uid = '$uid'";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {

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
}
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
                                                            value="<?= $user['officer_name']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="">Officer Rank</label>
                                                        <input type="text" name="officer_rank" class="form-control"
                                                            value="<?= $user['officer_rank']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="">User ID</label>
                                                        <input type="text" name="user_id" class="form-control"
                                                            value="<?= $user['user_id']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="">User Type</label>
                                                        <select class="form-select form-select-lg" name="user_type"
                                                            id="user_type" value="<?= $user['user_type']; ?>">
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
                                                        <select class="form-select form-select-lg" name="district"
                                                            id="district">
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
                                                        <select class="form-select form-select-lg" name="police_station"
                                                            id="police_station" value="<?= $user['police_station']; ?>">
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