<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";
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
                        <a href="manage_user.php" class="nav-link link-dark">
                            Manage Users
                        </a>
                    </li>
                    <li>
                        <a href="view_logs.php" class="nav-link active">
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
            </div>
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

        <div class="main-content col-md-9 col-sm-7">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Log Files</div>
                </div>
                <div class="card-body">
                    <div class="table-container" style="width:auto; height:70vh; overflow: scroll;">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th>Serial Number</th>
                                    <th>Table Name</th>
                                    <th>Table ID</th>
                                    <th>Operation</th>
                                    <th>Description</th>
                                    <th>Log By</th>
                                    <th>Log Date</th>
                                    <th>Log Time</th>
                                    <th>When?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query1 = "SELECT * FROM logs ORDER BY created_at";
                                $stmt1 = mysqli_prepare($con, $query1);
                                mysqli_stmt_execute($stmt1);
                                $query_run1 = mysqli_stmt_get_result($stmt1);

                                if (mysqli_num_rows($query_run1) > 0) {
                                    while ($log = mysqli_fetch_assoc($query_run1)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= htmlspecialchars($log['lid']); ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars(ucfirst($log['table_name'])); ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars($log['table_id']); ?>
                                            </td>
                                            <td class="text-<?php
                                            if ($log['operation'] == "insert") {
                                                echo "success";
                                            } else if ($log['operation'] == "update") {
                                                echo "primary";
                                            } else if ($log['operation'] == "delete") {
                                                echo "danger";
                                            } else if ($log['operation'] == "login") {
                                                echo "warning";
                                            } else {
                                                echo "dark";
                                            }
                                            ?>">
                                                <?= htmlspecialchars(ucfirst($log['operation'])); ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars($log['log_desc']); ?>
                                            </td>
                                            <td>
                                                <?php
                                                $user = $log['created_by'];
                                                $query2 = "SELECT * FROM users WHERE user_id = ?";
                                                $stmt2 = mysqli_prepare($con, $query2);
                                                mysqli_stmt_bind_param($stmt2, "s", $user);
                                                mysqli_stmt_execute($stmt2);
                                                $query_run2 = mysqli_stmt_get_result($stmt2);
                                                $officer = mysqli_fetch_array($query_run2)['officer_name']; ?>
                                                <?= htmlspecialchars($officer); ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars((new DateTime($log['created_at']))->format('Y-m-d')); ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars((new DateTime($log['created_at']))->format('H:i:s')); ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars(getTimeAgo($log['created_at'])); ?>
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
</main>

<!-- place footer here -->
<?php include('../footer.php'); ?>

</body>

</html>