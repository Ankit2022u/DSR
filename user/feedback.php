<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";

if (isset($_POST['save_feedback'])) {
    $feedback = $_POST['feedback'];
    $updated_by = $_SESSION['user-data']['user_id'];

    // Validate input fields

    if (!(empty($feedback))) {
        $query = "INSERT INTO `feedbacks`(`feedback`, `created_by`) VALUES ('$feedback','$updated_by')";
        $query_run = mysqli_query($con, $query);


        if ($query_run) {

            $inserted_id = mysqli_insert_id($con);
            $user = $_SESSION['user-data']['user_id'];
            $user_name = $_SESSION['user-data']['officer_name'];
            $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1,'$user','feedbacks','$inserted_id','insert', 'Feedback given by $user_name.')";
            $log_query_run = mysqli_query($con, $log_query);

            $_SESSION['message'] == "Successfully submitted feedback.";
            $_SESSION['type'] == "success";
        } else {
            $_SESSION['message'] == "Failed to submit Feedback";
            $_SESSION['type'] == "danger";
        }
    } else {
        $_SESSION['message'] == "Feedback Field can't be empty.";
        $_SESSION['type'] == "warning";
    }
}



?>

<header>
    <!-- place navbar here -->
    <?php include('user_header.php'); ?>
</header>

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
                            User Dashboard / डैशबोर्ड
                        </a>
                    </li>

                    <li>
                        <a href="dead_body_form.php" class="nav-link link-dark">
                             Inquest / मर्ग
                        </a>
                    </li>

                    <li>
                        <a href="major_crime_form.php" class="nav-link link-dark">
                            Major Crime / गंभीर अपराध
                        </a>
                    </li>

                    <li>
                        <a href="ongoing_case_form.php" class="nav-link link-dark">
                            Ongoing Case / सक्रिय मामला
                        </a>
                    </li>

                    <li>
                        <a href="minor_crime_form.php" class="nav-link link-dark">
                            Minor Crime / सामान्य अपराध
                        </a>
                    </li>
                    <!-- <li>
                        <a class="nav-link link-dark" href="edit.php">
                            Edit
                        </a>
                    </li> -->


                    <li>
                        <a class="nav-link active" href="feedback.php">
                            Feedback / फीडबैक
                        </a>
                    </li>

                    <li>
                        <a href="profile.php" class="nav-link link-dark">
                            Profile / प्रोफाइल
                        </a>
                    </li>

                    <li>
                        <a href="change_password.php" class="nav-link link-dark">
                            Change Password / पासवर्ड को बदले
                        </a>
                    </li>

                    <li>
                        <a href="court_judgement_form.php" class="nav-link link-dark">
                            Court Judgement / कोर्ट का निर्णय
                        </a>
                    </li>

                    <li>
                        <a href="important_achievements_form.php" class="nav-link link-dark">
                            Important Achievements / महत्वपूर्ण कार्यवाही
                        </a>
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
        <div class="main-content col-md-9 col-sm-7">
            <form action="feedback.php" method="post">
                <div class="container px-5 my-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea name="feedback" id="feedback" class="form-control" type="text"
                                    placeholder="Feedback" style="height: 10rem;" name="feedback" required></textarea>
                                <label for="feedback">Feedback</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" name="save_feedback" class="btn btn-primary">Submit Feedback</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</main>


<!-- place footer here -->
<?php include('../footer.php'); ?>

</body>

</html>