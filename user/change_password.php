<?php
session_start();
require '../api/functions.php';

if (!(isset($_SESSION['user-data']))) {
    header("Location: ../index.php");
}

?>
<?php include('user_header.php'); ?>
<main>
    <div class="row">

        <div class="side-bar col-md-3 col-sm-5">
            <?php //include('side-bar.php'); 
            ?>
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                <!-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Daily Station Report (User Panel)</span>
                </a>
                <hr> -->
                <ul class="nav nav-pills flex-column mb-auto">

                    <li class="nav-item">
                        <a href="user.php" class="nav-link link-dark" aria-current="page">
                            User Dashboard
                        </a>
                    </li>

                    <li>
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
                    <!-- <li>
                        <a class="nav-link link-dark" href="edit.php">
                            Edit
                        </a>
                    </li> -->


                    <li>
                        <a class="nav-link link-dark" href="feedback.php">
                            Feedback
                        </a>
                    </li>

                    <li>
                        <a href="profile.php" class="nav-link link-dark">
                            Profile
                        </a>
                    </li>

                    <li>
                        <a href="change_password.php" class="nav-link active">
                            Change Password
                        </a>
                    </li>

                    <li>
                        <a href="court_judgement_form.php" class="nav-link link-dark">
                            Change Password
                        </a>
                    </li>

                    <li>
                        <a href="impotant_achievements_form.php" class="nav-link link-dark">
                            Important Achievements
                    </li>

                </ul>
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
                                        <label for="old_password" class="form-label">Old Password<span
                                                class="required-star">*</span></label>
                                        <input type="password" id="old_password" class="form-control"
                                            name="old_password" placeholder="Enter Current Password" required>
                                        <span class="pass_icon" onclick="changeIcon(1)"><i id="icon1"
                                                class="bi bi-eye-fill"></i></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">New Password<span
                                                class="required-star">*</span></label>
                                        <input type="password" id="new_password" class="form-control"
                                            name="new_password" placeholder="Enter New Password" required>
                                        <span class="pass_icon" onclick="changeIcon(2)"><i id="icon2"
                                                class="bi bi-eye-fill"></i></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_new_password" class="form-label">Confirm New
                                            Password<span class="required-star">*</span></label>
                                        <input type="password" id="confirm_new_password" class="form-control"
                                            name="confirm_new_password" placeholder="Confirm New Password" required>
                                        <span class="pass_icon" onclick="changeIcon(3)"><i id="icon3"
                                                class="bi bi-eye-fill"></i></span>
                                    </div>
                                    <div class="mb-3 d-grid">
                                        <button type="submit" class="btn btn-primary" name="change_password_user">
                                            Reset Password
                                        </button>
                                    </div>
                                </form>
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