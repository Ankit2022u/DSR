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

<!-- place navbar here -->
<?php include('user_header.php'); ?>

<main>
    <div class="row">
        <?php
        // Define the active page variable based on the current page
        $active_page = basename($_SERVER['PHP_SELF'], ".php");
        // Include the side-bar.php file
        include 'side-bar.php';
        ?>


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