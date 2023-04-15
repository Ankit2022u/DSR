<!doctype html>
<html lang="en">

<head>
    <title>User-Dashboard | DSR</title>
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
    </style>
</head>

<body>
    <header class="mb-2">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand active" href="admin.php">Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="manage_user.php">Manage Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_logs.php">View Logs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_data.php">View Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="major_crime_form.php">Major Crime</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="change_password.php">Change Password</a>
                        </li>
                    </ul>
                    <img src="../assets/img/logo.jpeg" alt="Logo for Admin Dashboard" width="50" height="50"
                        class="d-inline-block align-text-top mr-3">
                    <div class="float-end"><a href="../auth/logout.php" class="btn btn-outline-danger" name="logout">Log Out</a></div>
                </div>
            </div>
        </nav>
    </header>