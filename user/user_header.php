<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!(isset($_SESSION['user-data']))) {
    header("Location: ../index.php");
    exit(); // Added exit() to prevent further code execution after redirect
}
?>
<!doctype html>
<html lang="hi">

<head>
    <title>User Dashboard | DSR</title>
    <!-- for icon -->
    <link rel="icon" type="image/png" href="../assets/img/icon.png">
    <!-- Required meta tags -->
    <meta charset="utf-32">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Language" content="hi">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-32">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <script src="https://kit.fontawesome.com/aa2f2c478b.js" crossorigin="anonymous"></script>
    <script src="../assets/js//password.js"></script>
    <style>
        /* body {
            background: linear-gradient(to bottom left, #FFFDDE, #45A9BA);
        } */

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
                <img src="../assets/img/logo.jpeg" alt="Logo for User Dashboard" width="50" height="50" class="d-inline-block align-text-top mr-3">
                <a href="user.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Daily Station Report (User Panel)</span>
                </a>
                <!-- <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        Navigation links here
                    </ul>
                    <div class="float-end"><a href="../auth/logout.php" class="btn btn-outline-danger" name="logout">Log
                            Out</a></div>
                </div> -->
            </div>
        </nav>
    </header>