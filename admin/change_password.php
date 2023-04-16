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

        <div class="side-bar col-md-3 col-sm-5">
            <?php include('side-bar.php'); ?>
        </div>

        <div class="main-content container col-md-9 col-sm-7">

            <div class="container d-flex flex-column">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="card shadow-sm">
                            <?php if (isset($_SESSION['message'])) {
                                ?>
                                <div class="alert alert-<?= $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                                    <span>
                                        <?= $_SESSION['message']; ?>
                                    </span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                <?php unset($_SESSION['message']);
                            } ?>

                            <div class="card-body">
                                <form method="POST" action="../auth/change_password.php">
                                    <input type="hidden" id="user_id" class="form-control" name="user_id"
                                        value="<?= $_SESSION['user-data']['user_id']; ?>">
                                    <div class="mb-3">
                                        <label for="old_password" class="form-label">Old Password</label>
                                        <span class="required-star">*</span>
                                        <input type="password" id="old_password" class="form-control"
                                            name="old_password" placeholder="Enter Current Password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <span class="required-star">*</span>
                                        <input type="password" id="new_password" class="form-control"
                                            name="new_password" placeholder="Enter New Password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_new_password" class="form-label">Confirm New
                                            Password</label>
                                        <span class="required-star">*</span>
                                        <input type="password" id="confirm_new_password" class="form-control"
                                            name="confirm_new_password" placeholder="Confirm New Password" required>
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