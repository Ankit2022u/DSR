<?php
session_start();
require "../api/dbcon.php";
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
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <?php
                                if (isset($_SESSION['message'])) {
                                    $type = htmlspecialchars($_SESSION['type'], ENT_QUOTES, 'UTF-8');
                                    $message = htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8');
                                ?>
                                <div class="alert alert-<?= $type; ?> alert-dismissible fade show" role="alert">
                                    <strong>Information: </strong>
                                    <?= $message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                <?php
                                    unset($_SESSION['message']);
                                }
                                ?>

                                <h4>User details
                                    <a href="create_user.php" class="btn btn-primary float-end">Add User</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-container" style="width:auto; overflow: scroll;">

                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>User ID</th>
                                                <th>Officer Name</th>
                                                <th>Officer Rank</th>
                                                <th>Police Station</th>
                                                <!-- <th>Password</th> -->
                                                <th>User Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM users";
                                            $query_run = mysqli_prepare($con, $query);
                                            mysqli_stmt_execute($query_run);
                                            $result = mysqli_stmt_get_result($query_run);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($user = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <!-- Display user data in table rows with proper output encoding -->
                                            <tr>
                                                <td>
                                                    <?= htmlspecialchars($user['uid']); ?>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars($user['user_id']); ?>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars($user['officer_name']); ?>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars($user['officer_rank']); ?>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars($user['police_station']); ?>
                                                </td>
                                                <!-- <td>
                                                            <= htmlspecialchars($user['password']); ?>
                                                        </td> -->
                                                <td>
                                                    <?php if ($user['user_type'] == "admin") {
                                                                echo "Administration";
                                                            } else {
                                                                echo "User";
                                                            } ?>
                                                </td>
                                                <td>
                                                    <?php if ($user['status']) {
                                                                echo '<span class="badge text-bg-success">Activated</span>';
                                                                $color = "danger";
                                                            } else {
                                                                echo '<span class="badge text-bg-danger">Deactivated</span>';
                                                                $color = "success";
                                                            } ?>
                                                </td>
                                                <td>
                                                    <a href="update_user.php?uid=<?= htmlspecialchars($user['uid']); ?>"
                                                        class="btn btn-primary">Edit</a>
                                                    <form action="change_user_status.php" method="post"
                                                        class="d-inline">
                                                        <button type="submit" name="change_status"
                                                            value=<?= htmlspecialchars($user['uid']); ?>
                                                            class="btn btn-<?= $color; ?>">
                                                            <?php if ($user['status']) {
                                                                        echo 'Deactivate';
                                                                    } else {
                                                                        echo 'Activate';
                                                                    } ?>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <?php
                                                }
                                            } else {
                                                echo "No Records Found";
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
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