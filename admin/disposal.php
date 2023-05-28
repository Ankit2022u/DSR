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

        <div class="side-bar col-md-3 col-sm-5">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                <!-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Daily Station Report (Admin Panel)</span>
                </a>
                <hr> -->
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link link-dark" aria-current="page">
                            Dashboard / डैशबोर्ड
                        </a>
                    </li>
                    <li>
                        <a href="manage_user.php" class="nav-link link-dark">
                            Manage Users / उपयोगकर्ताओं का प्रबंधन
                        </a>
                    </li>
                    <li>
                        <a href="view_logs.php" class="nav-link link-dark">
                            View Logs / लॉग्स को देखें
                        </a>
                    </li>
                    <li>
                        <a href="view_data.php" class="nav-link link-dark">
                            View Data / डेटा का हिसाब
                        </a>
                    </li>
                    <li>
                        <a href="change_password.php" class="nav-link link-dark">
                            Change Password / पासवर्ड को बदले
                        </a>
                    </li>
                    <li>
                        <a href="police_station.php" class="nav-link link-dark">
                            Police Stations / थाना
                        </a>
                    </li>
                    <li>
                        <a href="profile.php" class="nav-link link-dark">
                            View Profile / प्रोफाइल
                        </a>
                    </li>
                    <li>
                        <a href="dbf.php" class="nav-link link-dark">
                            Inquest / मर्ग
                        </a>
                    </li>
                    <li>
                        <a href="mcf.php" class="nav-link link-dark">
                            Major Crime / गंभीर अपराध
                        </a>
                    </li>
                    <li>
                        <a href="micf.php" class="nav-link link-dark">
                            Minor Crime / सामान्य अपराध
                        </a>
                    </li>
                    <li>
                        <a href="ocf.php" class="nav-link link-dark">
                            Ongoing Case / सक्रिय मामला
                        </a>
                    </li>
                    <li>
                        <a href="cjf.php" class="nav-link link-dark">
                            Court judgement / कोर्ट का निर्णय
                        </a>
                    </li>

                    <li>
                        <a href="iaf.php" class="nav-link link-dark">
                            Important Achievements / मुख्य उपलब्धियां
                        </a>
                    </li>

                    <li>
                        <a href="disposal.php" class="nav-link active">
                            Disposals / निकाल 
                        </a>
                    </li>

                </ul>
                <hr>
                <div class="profile">
                    <img src="../uploads/<?= htmlspecialchars($_SESSION['user-data']['user_type'], ENT_QUOTES, 'UTF-8'); ?>/<?= htmlspecialchars($_SESSION['user-data']['profile_photo_path'], ENT_QUOTES, 'UTF-8'); ?>" alt="Profile Pic" width="32" height="32" class="rounded-circle me-2">
                    <strong>
                        <?= htmlspecialchars($_SESSION['user-data']['officer_name'], ENT_QUOTES, 'UTF-8'); ?>
                    </strong>
                    <a href="../auth/logout.php" class="btn btn-outline-danger m-2" name="logout">Log Out</a>
                </div>

            </div>
        </div>

        <div class="main-content container col-md-9 col-sm-7">

        </div>
    </div>
</main>

<?php include('../footer.php'); ?>

</body>

</html>