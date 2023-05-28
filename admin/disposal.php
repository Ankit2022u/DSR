<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";

if (!(isset($_SESSION['user-data']))) {
    header("Location: ../index.php");
    exit; // added exit to prevent further code execution
}

if (isset($_POST['view'])) {
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);
    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
    $dead_bodies = isset($_POST['dead_bodies']) ? 1 : 0;
    $ongoing_cases = isset($_POST['ongoing_cases']) ? 1 : 0;
    $minor_crimes = isset($_POST['minor_crimes']) ? 1 : 0;
    $major_crimes = isset($_POST['major_crimes']) ? 1 : 0;
    $important_achievements = isset($_POST['important_achievements']) ? 1 : 0;
    $court_judgements = isset($_POST['court_judgements']) ? 1 : 0;
    $districts = get_districts();

    $errors = array();
    // Validate input fields
    $errors = array();
    if (empty($start_date)) {
        $errors[] = "Start Date is required";
    }
    if (empty($end_date)) {
        $errors[] = "End Date is required.";
    }
    if (!($dead_bodies or $ongoing_cases or $minor_crimes or $major_crimes or $important_achievements or $court_judgements)) {
        $errors[] = "Select Atleast One Information You Want";
    }

    if (empty($errors)) {
        $output_dead_bodies = array();
        $output_minor_crimes = array();
        $output_major_crimes = array();
        $output_ongoing_cases = array();
        $output_important_achievements = array();
        $output_court_judgements = array();

        if ($district == 'All') {
            foreach ($districts as $row) {
                if ($dead_bodies) {
                    $output_dead_bodies[] = find_dead_bodies($row['district'], $start_date, $end_date);
                }
                if ($minor_crimes) {
                    $output_minor_crimes[] = find_minor_crimes($row['district'], $start_date, $end_date);
                }
                if ($major_crimes) {
                    $output_major_crimes[] = find_major_crimes($row['district'], $start_date, $end_date);
                }
                if ($ongoing_cases) {
                    $output_ongoing_cases[] = find_ongoing_cases($row['district'], $start_date, $end_date);
                }
                if ($important_achievements) {
                    $output_important_achievements[] = find_important_achievements($row['district'], $start_date, $end_date);
                }
                if ($court_judgements) {
                    $output_court_judgements[] = find_court_judgements($row['district'], $start_date, $end_date);
                }
            }
        } else {
            if ($dead_bodies) {
                $output_dead_bodies[] = find_dead_bodies($district, $start_date, $end_date);
            }
            if ($minor_crimes) {
                $output_minor_crimes[] = find_minor_crimes($district, $start_date, $end_date);
            }
            if ($major_crimes) {
                $output_major_crimes[] = find_major_crimes($district, $start_date, $end_date);
            }
            if ($ongoing_cases) {
                $output_ongoing_cases[] = find_ongoing_cases($district, $start_date, $end_date);
            }
            if ($important_achievements) {
                $output_important_achievements[] = find_important_achievements($district, $start_date, $end_date);
            }
            if ($court_judgements) {
                $output_court_judgements[] = find_court_judgements($district, $start_date, $end_date);
            }
        }

        $_SESSION['ongoing_cases'] = $output_ongoing_cases;
        $_SESSION['major_crimes'] = $output_major_crimes;
        $_SESSION['minor_crimes'] = $output_minor_crimes;
        $_SESSION['dead_bodies'] = $output_dead_bodies;
        $_SESSION['important_achievements'] = $output_important_achievements;
        $_SESSION['court_judgements'] = $output_court_judgements;
        $_SESSION['start_date'] = $start_date;
        $_SESSION['end_date'] = $end_date;
    } else {

        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";
        header('Location: view_data.php');
    }
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

        </div>
    </div>
</main>

<?php include('../footer.php'); ?>

</body>

</html>