<?php
session_start();
require '../api/functions.php';

if (!(isset($_SESSION['user-data']))) {
    header("Location: ../index.php");
}

?>
<?php include('admin_header.php'); ?>
<main>
    <div class="row">

        <?php
        // Define the active page variable based on the current page
        $active_page = basename($_SERVER['PHP_SELF'], ".php");
        // Include the side-bar.php file
        include 'side-bar.php';
        ?>

        <div class="main-content container col-md-9 col-sm-7">

            <div class="container d-flex flex-column">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="card shadow-sm">
                            <?php
                            if (isset($_SESSION['message']) && isset($_SESSION['type'])) {
                                $message = $_SESSION['message'];
                                $type = $_SESSION['type'];

                                // Sanitize message and type to prevent XSS attacks
                                $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
                                $type = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');

                            ?>
                            <div class="alert alert-<?= $type; ?> alert-dismissible fade show" role="alert">
                                <span>
                                    <?= $message; ?>
                                </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php
                                unset($_SESSION['message']);
                                unset($_SESSION['type']);
                            }
                            ?>

                            <div class="card-body">
                                <form method="POST" action="../auth/change_password.php">
                                    <input type="hidden" id="user_id" class="form-control" name="user_id"
                                        value="<?= $_SESSION['user-data']['user_id']; ?>">
                                    <div class="mb-3">
                                        <label for="old_password" class="form-label">Old Password</label>
                                        <span class="required-star">*</span>
                                        <input type="password" id="old_password" class="form-control"
                                            name="old_password" placeholder="Enter Current Password" required>
                                        <span class="pass_icon" onclick="changeIcon(1)"><i id="icon1"
                                                class="bi bi-eye-fill"></i></span>

                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <span class="required-star">*</span>
                                        <input type="password" id="new_password" class="form-control"
                                            name="new_password" placeholder="Enter New Password" required>
                                        <span class="pass_icon" onclick="changeIcon(2)"><i id="icon2"
                                                class="bi bi-eye-fill"></i></span>

                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_new_password" class="form-label">Confirm New
                                            Password</label>
                                        <span class="required-star">*</span>
                                        <input type="password" id="confirm_new_password" class="form-control"
                                            name="confirm_new_password" placeholder="Confirm New Password" required>
                                        <span class="pass_icon" onclick="changeIcon(3)"><i id="icon3"
                                                class="bi bi-eye-fill"></i></span>
                                    </div>
                                    <div class="mb-3 d-grid">
                                        <button type="submit" class="btn btn-primary" name="change_password_admin">
                                            Reset Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <ul>
                                    <li>
                                        Minimum password length of 8 characters
                                    </li>
                                    <li>
                                        Minimum password length of 8 characters
                                    </li>
                                    <li>
                                        Maximum password length of 20 characters
                                    </li>
                                    <li>
                                        Password must contain at least one uppercase letter
                                    </li>
                                    <li>
                                        Password must contain at least one lowercase letter
                                    </li>
                                    <li>
                                        Password must contain at least one number
                                    </li>
                                    <li>
                                        Password must contain at least one special character
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>


<?php include('../footer.php'); ?>

</body>

</html>