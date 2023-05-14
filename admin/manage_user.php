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
                            View Profile /  प्रोफाइल
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
                                <?php
                                if (isset($_SESSION['message'])) {
                                    $type = htmlspecialchars($_SESSION['type'], ENT_QUOTES, 'UTF-8');
                                    $message = htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8');
                                ?>
                                    <div class="alert alert-<?= $type; ?> alert-dismissible fade show" role="alert">
                                        <strong>Information: </strong>
                                        <?= $message; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                                            <a href="update_user.php?uid=<?= htmlspecialchars($user['uid']); ?>" class="btn btn-primary">Edit</a>
                                                            <form action="change_user_status.php" method="post" class="d-inline">
                                                                <button type="submit" name="change_status" value=<?= htmlspecialchars($user['uid']); ?> class="btn btn-<?= $color; ?>">
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