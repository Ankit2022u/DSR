<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// unset($_SESSION['message']);

if (!(isset($_SESSION['user-data']))) {
    header("Location: ../index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Admin-Dashboard | DSR</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/aa2f2c478b.js" crossorigin="anonymous"></script>
    <script src="../assets/js/password.js"></script>
    <style>
        footer {
            background-color: rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        .required-star {
            color: red;
            margin-left: 5px;
        }


        .pass_icon {
            float: right;
            margin-top: -30px;
            margin-right: 15px;

        }
    </style>
</head>

<body>
    <header class="mb-2">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">

                <img src="../assets/img/logo.jpeg" alt="Logo for Admin Dashboard" width="50" height="50"
                    class="d-inline-block align-text-top mr-3">
                <a href="admin.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Daily Station Report (Admin Panel)</span>
                </a>
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="manage_user.php">Manage Users</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="view_logs.php">View Logs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_data.php">View Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">View Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="change_password.php">Change Password</a>
                        </li> -->
                    </ul> 
                    <div class="float-end">
                        <img src="../uploads/<?= $_SESSION['user-data']['user_type']; ?>/<?= $_SESSION['user-data']['profile_photo_path']; ?>"
                            alt="Profile Pic" width="32" height="32" class="rounded-circle me-2">
                        <strong>
                            <?= $_SESSION['user-data']['officer_name']; ?>
                        </strong>
                        <a href="../auth/logout.php" class="btn btn-outline-danger" name="logout">Log
                            Out</a>
                    </div>

                </div>
            </div>
        </nav>
    </header>