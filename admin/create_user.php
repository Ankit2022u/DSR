<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";

$police_stations = police_stations();

if (isset($_POST['save_user'])) {

    $officer_name = mysqli_real_escape_string($con, $_POST['officer_name']);
    $officer_rank = mysqli_real_escape_string($con, $_POST['officer_rank']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    if ($password == $confirm_password) {
        $query = "INSERT INTO users(officer_name, officer_rank, user_id, user_type, district, status, police_station, password) VALUES ('$officer_name', '$officer_rank', '$user_id', '$user_type', '$district', 0, '$police_station', '$password')";
        echo $query;

        $query_run = mysqli_query($con, $query);

        if ($query_run) {

            $_SESSION['message'] = "User created successfully";
            header("Location: create_user.php");
            exit(0);
        } else {
            $_SESSION['message'] = "User creation failed due to some error.";
            header("Location: create_user.php");
            exit(0);
        }
    }
    else{
        $_SESSION['message'] = "Password does not match.";
        header("Location: create_user.php");
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
                                <form action="create_user.php" method="POST">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="">Officer Name</label>
                                                <input type="text" name="officer_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="">Officer Rank</label>
                                                <input type="text" name="officer_rank" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="">User ID</label>
                                                <input type="text" name="user_id" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="">User Type</label>
                                                <select class="form-select form-select-lg" name="user_type"
                                                    id="user_type">
                                                    <option selected value="user">User</option>
                                                    <option value="admin">Administration</option>
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
                                                    <option value="Surguja">Surguja</option>
                                                    <option value="Balrampur">Balrampur</option>
                                                    <option value="Surajpur">Surajpur</option>
                                                    <option value="Jashpur">Jashpur</option>
                                                    <option value="Manendragarh-Chirmiri-Bharatpur">
                                                        Manendragarh-Chirmiri-Bharatpur
                                                    </option>
                                                    <option value="Korea">Korea</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Police Station</label>
                                                <select class="form-select form-select-lg" name="police_station"
                                                    id="police_station">
                                                    <?php foreach ($police_stations as $option) {
                                                        ?><option value="<?= $option['police_station']; ?>"><?= $option['police_station']; ?></option><?php
                                                    } ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="">Password</label>
                                                <input type="text" name="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="">Confirm Password</label>
                                                <input type="text" name="confirm_password" class="form-control">
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