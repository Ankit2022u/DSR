<?php
if (isset($_POST['login'])) {
    $user_type = $_POST['login'];
} else {
    session_start();
    if (isset($_SESSION['login_type'])) {
        $user_type = $_SESSION['login_type'];
    } else {
        $user_type = 'user';
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Login | Daily Station Report</title>

    <link rel="icon" type="image/png" href="assets/img/icon.png">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <script src="./assets/js/password.js"></script>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .form {
            padding: 5px;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        .pass_icon {
            float: right;
            margin-top: -35px;
            margin-right: 15px;
        }

        /* .required-star {
            color: red;
            margin-left: 5px;
        } */
    </style>
</head>

<body>
    <header>
        <?php include('header.php'); ?>
    </header>

    <!-- Main body -->
    <section class="main">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="assets/img/login-image.jpg" class="img-fluid" alt="login-img">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <div class="card p-lg-3">
                        <?php if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (isset($_SESSION['message'])) {

                        ?>
                            <div class="alert alert-<?= $_SESSION['type'] ?>" role="alert">
                                <strong>
                                    <?= $_SESSION['message']; ?>
                                </strong>
                            </div>
                        <?php
                        }
                        session_destroy(); ?>
                        <div class="card-header">
                            <h4 class="text-center">
                                <?= ucfirst($user_type); ?> Login
                            </h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="auth/auth.php" class="form">
                                <input type="hidden" name="user_type" value=<?= $user_type; ?>>
                                <!-- User ID input -->
                                <div class="form-outline mb-4">
                                    <input type="text" name="user_id" id="user_id" class="form-control form-control-lg" required />
                                    <label class="form-label" for="user_id">User ID</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" required />

                                    <span class="pass_icon" onclick="changeIcon(4)"><i id="icon4" class="bi bi-eye-fill"></i></span>
                                    <label class="form-label" for="password">Password</label>
                                </div>

                                <!-- Forget Password Link -->
                                <div class="d-flex justify-content-around align-items-center mb-4">
                                    <a href="forget-password.php">Forgot password?</a>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" name="login" class="btn btn-success btn-lg btn-block float-end">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include('footer.php'); ?>
</body>

</html>