<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";

if (!(isset($_SESSION['user-data']))) {
    header("Location: ../index.php");
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
    $districts = districts();

    $errors = array();
    // Validate input fields
    $errors = array();
    if (empty($start_date)) {
        $errors[] = "Start Date is required";
    }
    if (empty($end_date)) {
        $errors[] = "End Date is required.";
    }
    if (!($dead_bodies and $ongoing_cases and $minor_crimes and $major_crimes)) {
        $errors[] = "Select Atleast One Information You Want";
    }

    if (empty($errors)) {
        $output_dead_bodies = array();
        $output_minor_crimes = array();
        $output_major_crimes = array();
        $output_ongoing_cases = array();

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
        }

        $_SESSION['ongoing_cases'] = $output_ongoing_cases;
        $_SESSION['major_crimes'] = $output_major_crimes;
        $_SESSION['minor_crimes'] = $output_minor_crimes;
        $_SESSION['dead_bodies'] = $output_dead_bodies;

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
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Daily Station Report (Admin Panel)</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link link-dark" aria-current="page">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="manage_user.php" class="nav-link link-dark">
                            Manage Users
                        </a>
                    </li>
                    <li>
                        <a href="view_logs.php" class="nav-link link-dark">
                            View Logs
                        </a>
                    </li>
                    <li>
                        <a href="view_data.php" class="nav-link active">
                            View Data
                        </a>
                    </li>
                    <li>
                        <a href="change_password.php" class="nav-link link-dark">
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a href="police_station.php" class="nav-link link-dark">
                            Police Stations
                        </a>
                    </li>
                    <li>
                        <a href="profile.php" class="nav-link link-dark">
                            View Profile
                        </a>
                    </li>
                    <li>
                        <a href="dbf.php" class="nav-link link-dark">
                            Dead Body Form
                        </a>
                    </li>
                    <li>
                        <a href="mcf.php" class="nav-link link-dark">
                            Major Crime Form
                        </a>
                    </li>
                    <li>
                        <a href="micf.php" class="nav-link link-dark">
                            Minor Crime Form
                        </a>
                    </li>
                    <li>
                        <a href="ocf.php" class="nav-link link-dark">
                            Ongoing Case Form
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

        <div class="main-content container col-md-9 col-sm-7">

            <div class="row justify-content-center align-items-center g-2">
                <!-- Ongoing Cases -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="alert alert-light" role="alert">
                                <!-- Database Table Name -->
                                <strong>Ongoing Cases</strong>
                            </div>
                            <!-- Ongoing case download -->
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-12">
                                    <form action="../api/download.php" method="post" class="d-flex justify-content-end">
                                        <div class="p-2">
                                            <button type="submit" class="btn btn-primary"
                                                name="ongoing_case_download">Download</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-container" style="height: 400px; overflow: scroll;">
                                <table class="table table-bordered table-primary">
                                    <thead>
                                        <!-- Database Columns -->
                                        <th>Id</th>
                                        <th>District</th>
                                        <th>Sub-Division</th>
                                        <th>Police Station</th>
                                        <th>Crime Number</th>
                                        <th>Penal-Code</th>
                                        <th>FIR Date</th>
                                        <th>Culprit Name</th>
                                        <th>Case Status </th>
                                        <th>Name Of Court</th>
                                        <th>Culprit Address</th>
                                        <th>Judgement Of Court</th>
                                    </thead>

                                    <?php $i = 1;
                                    foreach ($output_ongoing_cases as $ongoingcase) {
                                        foreach ($ongoingcase as $row) {
                                            ?>
                                    <tbody>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= $row['district']; ?>
                                        </td>
                                        <td>
                                            <?= $row['sub_division']; ?>
                                        </td>
                                        <td>
                                            <?= $row['police_station']; ?>
                                        </td>
                                        <td>
                                            <?= $row['crime_number']; ?>
                                        </td>
                                        <td>
                                            <?= $row['penal_code']; ?>
                                        </td>
                                        <td>
                                            <?= $row['fir_date']; ?>
                                        </td>
                                        <td>
                                            <?= $row['culprit_name']; ?>
                                        </td>
                                        <td>
                                            <?= $row['case_status']; ?>
                                        </td>
                                        <td>
                                            <?= $row['name_of_court']; ?>
                                        </td>
                                        <td>
                                            <?= $row['culprit_address']; ?>
                                        </td>
                                        <td>
                                            <?= $row['judgement_of_court']; ?>
                                        </td>
                                    </tbody>
                                    <?php }
                                    } ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dead Bodies -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="alert alert-light" role="alert">
                                <!-- Database Table Name -->
                                <strong>Dead body</strong>
                            </div>
                            <!-- Deadbody download -->
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-12">
                                    <form action="../api/download.php" method="post" class="d-flex justify-content-end">
                                        <div class="p-2">
                                            <button type="submit" class="btn btn-primary"
                                                name="dead_body_download">Download</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-container" style="height: 400px; overflow: scroll;">
                                <table class="table table-bordered table-warning">
                                    <thead>
                                        <!-- Database Columns -->
                                        <th>Id</th>
                                        <th>District</th>
                                        <th>Sub-Division</th>
                                        <th>Police Station</th>
                                        <th>Dead Body No.</th>
                                        <th>Penal-Code</th>
                                        <th>Accident Date</th>
                                        <th>Accident Place</th>
                                        <th>Information Date</th>
                                        <th>Information Time</th>
                                        <th>Applicant Name</th>
                                        <th>Deceased Name</th>
                                        <th>FIR Writer</th>
                                        <th>Cause Of Death</th>
                                    </thead>

                                    <?php $i = 1;
                                    foreach ($output_dead_bodies as $deadbody) {
                                        foreach ($deadbody as $row) {
                                            ?>
                                    <tbody>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= $row['district']; ?>
                                        </td>
                                        <td>
                                            <?= $row['sub_division']; ?>
                                        </td>
                                        <td>
                                            <?= $row['police_station']; ?>
                                        </td>
                                        <td>
                                            <?= $row['dead_body_number']; ?>
                                        </td>
                                        <td>
                                            <?= $row['penal_code']; ?>
                                        </td>
                                        <td>
                                            <?= $row['accident_date']; ?>
                                        </td>
                                        <td>
                                            <?= $row['accident_place']; ?>
                                        </td>
                                        <td>
                                            <?= $row['information_date']; ?>
                                        </td>
                                        <td>
                                            <?= $row['information_time']; ?>
                                        </td>
                                        <td>
                                            <?= $row['applicant_name']; ?>
                                        </td>
                                        <td>
                                            <?= $row['deceased_name']; ?>
                                        </td>
                                        <td>
                                            <?= $row['fir_writer']; ?>
                                        </td>
                                        <td>
                                            <?= $row['cause_of_death']; ?>
                                        </td>
                                    </tbody>
                                    <?php
                                        }
                                    } ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center align-items-center g-2">
                <!-- Minor Crimes -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="alert alert-light" role="alert">
                                <!-- Database Table Name -->
                                <strong>Minor Crime</strong>
                            </div>
                            <!-- Minor crime donload -->
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-12">
                                    <form action="../api/download.php" method="post" class="d-flex justify-content-end">
                                        <div class="p-2">
                                            <button type="submit" class="btn btn-primary"
                                                name="minor_crime_download">Download</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-container" style="height: 400px; overflow: scroll;">
                                <table class="table table-bordered table-success">
                                    <thead>
                                        <!-- Database Columns -->
                                        <th>ID</th>
                                        <th>Time</th>
                                        <th>Date</th>
                                        <th>Culprit Name</th>
                                        <th>Penal Code</th>
                                        <th>FIR Writer</th>
                                    </thead>

                                    <?php $i = 1;
                                    foreach ($output_minor_crimes as $minorcrime) {
                                        foreach ($minorcrime as $row) {
                                            ?>
                                    <tbody>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= (new DateTime($row['time_date']))->format('H:i:s'); ?>
                                        </td>
                                        <td>
                                            <?= (new DateTime($row['time_date']))->format('Y-m-d'); ?>
                                        </td>
                                        <td>
                                            <?= $row['culprit_name']; ?>
                                        </td>
                                        <td>
                                            <?= $row['penal_code']; ?>
                                        </td>
                                        <td>
                                            <?= $row['fir_writer']; ?>
                                        </td>
                                    </tbody>
                                    <?php
                                        }
                                    } ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Major Crimes -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="alert alert-light" role="alert">
                                <!-- Database Table Name -->
                                <strong>Major Crime</strong>
                            </div>
                            <!-- Major crime download -->
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-12">
                                    <form action="../api/download.php" method="post" class="d-flex justify-content-end">
                                        <div class="p-2">
                                            <button type="submit" class="btn btn-primary"
                                                name="major_crime_download">Download</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-container" style="height: 400px; overflow: scroll;">
                                <table class="table table-bordered table-danger">
                                    <thead>
                                        <!-- Database Columns -->
                                        <th>Id</th>
                                        <th>District</th>
                                        <th>Sub-Division</th>
                                        <th>Police Station</th>
                                        <th>Crime Number</th>
                                        <th>Penal-Code</th>
                                        <th>Applicant Name</th>
                                        <th>Applicant Address</th>
                                        <th>Incident Date</th>
                                        <th>Incident Time</th>
                                        <th>Incident Place</th>
                                        <th>Reporting Date</th>
                                        <th>Reporting Time</th>
                                        <th>Culprit Name</th>
                                        <th>Culprit Address</th>
                                        <th>Arrest Date</th>
                                        <th>Arrest Time</th>
                                        <th>Victim Name</th>
                                        <th>Description Of Crime</th>
                                        <th>Major Crime</th>
                                        <th>FIR Writer</th>
                                    </thead>
                                    <?php $i = 1;
                                    foreach ($output_major_crimes as $majorcrime) {
                                        foreach ($majorcrime as $row) {
                                            ?>
                                    <tbody>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= $row['district']; ?>
                                        </td>
                                        <td>
                                            <?= $row['sub_division']; ?>
                                        </td>
                                        <td>
                                            <?= $row['police_station']; ?>
                                        </td>
                                        <td>
                                            <?= $row['crime_number']; ?>
                                        </td>
                                        <td>
                                            <?= $row['penal_code']; ?>
                                        </td>
                                        <td>
                                            <?= $row['applicant_name']; ?>
                                        </td>
                                        <td>
                                            <?= $row['applicant_address']; ?>
                                        </td>
                                        <td>
                                            <?= $row['incident_date']; ?>
                                        </td>
                                        <td>
                                            <?= $row['incident_time']; ?>
                                        </td>
                                        <td>
                                            <?= $row['incident_place']; ?>
                                        </td>
                                        <td>
                                            <?= $row['reporting_date']; ?>
                                        </td>
                                        <td>
                                            <?= $row['reporting_time']; ?>
                                        </td>
                                        <td>
                                            <?= $row['culprit_name']; ?>
                                        </td>
                                        <td>
                                            <?= $row['culprit_address']; ?>
                                        </td>
                                        <td>
                                            <?= $row['arrest_date']; ?>
                                        </td>
                                        <td>
                                            <?= $row['arrest_time']; ?>
                                        </td>
                                        <td>
                                            <?= $row['victim_name']; ?>
                                        </td>
                                        <td>
                                            <?= $row['description_of_crime']; ?>
                                        </td>
                                        <td>
                                            <?php if ($row['is_major_crime']) {
                                                        echo "<span class='text-danger'>Yes</span>";
                                                    } else {
                                                        echo "<span class='text-success'>No</span>";
                                                    } ?>
                                        </td>
                                        <td>
                                            <?= $row['fir_writer']; ?>
                                        </td>
                                    </tbody>
                                    <?php
                                        }
                                    } ?>

                                </table>
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