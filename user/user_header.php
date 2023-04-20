<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!(isset($_SESSION['user-data']))) {
    header("Location: ../index.php");
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>User Dashboard | DSR</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/aa2f2c478b.js" crossorigin="anonymous"></script>
    <style>
        footer {
            background-color: rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        .required-star {
            color: red;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <header class="mb-2">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img src="../assets/img/logo.jpeg" alt="Logo for User Dashboard" width="50" height="50"
                    class="d-inline-block align-text-top mr-3">
                <a href="user.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Daily Station Report (User Panel)</span>
                </a>
                <!-- <a class="navbar-brand active" href="user.php">User Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                        <!-- <li>
                            <a href="dead_body_form.php" class="nav-link link-dark">
                                Dead Body
                            </a>
                        </li>

                        <li>
                            <a href="major_crime_form.php" class="nav-link link-dark">
                                Major Crime
                            </a>
                        </li>

                        <li>
                            <a href="ongoing_case_form.php" class="nav-link link-dark">
                                Ongoing Case
                            </a>
                        </li>

                        <li>
                            <a href="minor_crime_form.php" class="nav-link link-dark">
                                Minor Crime
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="feedback.php">
                                Feedback
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">View Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="change_password.php">Change Password</a>
                        </li> -->

                    </ul>
                    <div class="float-end"><a href="../auth/logout.php" class="btn btn-outline-danger" name="logout">Log
                            Out</a></div>
                </div>
            </div>
        </nav>
    </header>