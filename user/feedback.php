<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";
$police_stations = police_stations();

if (isset($_POST['save_feedback'])) {
    $feedback = $_POST['feedback'];
    $updated_by = $_SESSION['user-data']['user_id'];
    $query = "INSERT INTO `feedbacks`(`feedback`, `created_by`) VALUES ('$feedback','$updated_by')";
    $query_run = mysqli_query($con, $query);

    if ($query) {
        $_SESSION['message'] == "Successfully submitted feedback.";
        $_SESSION['type'] == "success";

    } else {
        $_SESSION['message'] == "Failed to submit Feedback";
        $_SESSION['type'] == "danger";
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
            <?php include('side-bar.php'); ?>
        </div>
        <div class="main-content col-md-9 col-sm-7">
            <form action="feedback.php" method="post">
                <div class="container px-5 my-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea name="feedback" id="feedback" class="form-control" type="text"
                                    placeholder="Feedback" style="height: 10rem;" name="feedback"></textarea>
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