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

            <div class="row justify-content-center align-items-center g-2">
                <form action="../api/pdf.php" method="post" class="d-flex justify-content-end">
                    <div class="p-2">
                        <button type="submit" class="btn btn-danger" name="major_crime_download"> All pdf</button>
                    </div>
                </form>
                <!-- Ongoing Cases -->
                <div class="col-12">
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
                                            <button type="submit" class="btn btn-primary" name="ongoing_case_download">Download</button>
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
                                        <th>S.No. / क्रमांक</th>
                                        <th>District / ज़िला</th>
                                        <th>Sub-Division / अनुभाग</th>
                                        <th>Police Station / पुलिस थाना</th>
                                        <th>Crime Number / अपराध क्रमांक</th>
                                        <th>Penal-Code / धारा</th>
                                        <th>FIR Date / एफ.आई.आर. का दिनाक</th>
                                        <th>Culprit Name and Address / आरोपी/संदिग्ध का नाम व पता</th>
                                        <th>Case Status / प्ररण की अद्यतन स्थिति</th>
                                        <th>Name Of Court / न्यायालय का नाम</th>
                                        <th>Judgement Of Court / न्यायालय के फैसले का संक्षिप्त विवरण</th>
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
                                                    <?= $row['culprit_name']; ?> | <?= $row['culprit_address']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['case_status']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['name_of_court']; ?>
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
                <div class="col-12">
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
                                            <button type="submit" class="btn btn-primary" name="dead_body_download">Download</button>
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
                                        <th>S.No. / क्रमांक</th>
                                        <th>District / ज़िला</th>
                                        <th>Sub-Division / अनुभाग</th>
                                        <th>Police Station / पुलिस थाना</th>
                                        <th>Dead Body No. / मर्ग क्रमांक</th>
                                        <th>Penal-Code / धारा</th>
                                        <th>Accident Date / घटना दिनांक</th>
                                        <th>Accident Time / घटना का समय</th>
                                        <th>Accident Place / घटना स्थान</th>
                                        <th>Information Date / सूचना दिनांक</th>
                                        <th>Information Time / सूचना का समय</th>
                                        <th>Applicant Name / सूचक का नाम</th>
                                        <th>Deceased Name / मृतक का नाम</th>
                                        <th>FIR Writer / कायमीकर्ता</th>
                                        <th>Cause Of Death / मृत्यु का कारण</th>
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
                                                    <?= $row['accident_time']; ?>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="alert alert-light" role="alert">
                                <!-- Minor Crime Download -->
                                <strong>Minor Crime</strong>
                            </div>
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-12">
                                    <form action="../api/download.php" method="post" class="d-flex justify-content-end">
                                        <div class="p-2">
                                            <button type="submit" class="btn btn-primary" name="minor_crime_download">Download</button>
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
                                        <th>S.No. / क्रमांक</th>
                                        <th>District / ज़िला</th>
                                        <th>Sub-Division / अनुभाग</th>
                                        <th>Police Station / पुलिस थाना</th>
                                        <th>Incident Date / घटना दिनांक</th>
                                        <th>Incident Time / घटना समय</th>
                                        <th>No of People / व्यक्तियों की संख्या</th>
                                        <th>Penal Code / धारा</th>
                                        <th>FIR Writer / कायमीकर्ता</th>
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
                                                    <?= $row['district']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['sub_division']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['police_station']; ?>
                                                </td>
                                                <td>
                                                    <?= (new DateTime($row['time_date']))->format('H:i:s'); ?>
                                                </td>
                                                <td>
                                                    <?= (new DateTime($row['time_date']))->format('Y-m-d'); ?>
                                                </td>
                                                <td>
                                                    <?= $row['culprit_number']; ?>
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
                <div class="col-12">
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
                                            <button type="submit" class="btn btn-primary" name="major_crime_download">Download excel</button>
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
                                        <th>S.No. / क्रमांक</th>
                                        <th>District / ज़िला</th>
                                        <th>Sub-Division / अनुभाग</th>
                                        <th>Police Station / पुलिस थाना</th>
                                        <th>Crime Number / अपराध क्रमांक</th>
                                        <th>Penal-Code / धारा</th>
                                        <th>Applicant Name and Address / प्रार्थी का नाम एवम् पता</th>
                                        <th>Incident Date / घटना दिनांक</th>
                                        <th>Incident Time / घटना का समय</th>
                                        <th>Incident Place / घटना स्थल</th>
                                        <th>Reporting Date / सूचना दिनाक</th>
                                        <th>Reporting Time / सूचना का समय</th>
                                        <th>Culprit Name and Address / आरोपी/संदिग्ध का नाम व पता</th>
                                        <th>Arrest Date / गिरफ्तारी का दिनाक</th>
                                        <th>Arrest Time / गिरफ्तारी का समय</th>
                                        <th>Victim Name / पीड़ित का नाम</th>
                                        <th>Description Of Crime / अपराध का संक्षिप्त विवरण</th>
                                        <th>Major Crime / गंभीर अपराध</th>
                                        <th>FIR Writer / कायमीकर्ता</th>
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
                                                    <?= $row['applicant_name']; ?> | <?= $row['applicant_address']; ?>
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
                                                    <?= $row['culprit_name']; ?> | <?= $row['culprit_address']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['arrest_date']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['arrest_time']; ?>
                                                </td>
                                                <td>
                                                    <?php if ($row['is_major_crime']) {
                                                        echo "<span class='text-danger'>Hidden (" . $row['victim_name'] . " )</span>";
                                                    } else {
                                                        echo "<span class='text-danger'>" . $row['victim_name'] . "</span>";
                                                    } ?>
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

            <div class="row justify-content-center align-items-center g-2">
                <!-- Important Achievements -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="alert alert-light" role="alert">
                                <strong>Important Achievement / महत्वपूर्ण कार्यवाही</strong>
                            </div>
                            <!-- Important Achievements download -->
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-12">
                                    <form action="../api/download.php" method="post" class="d-flex justify-content-end">
                                        <div class="p-2">
                                            <button type="submit" class="btn btn-primary" name="important_achievement_download">Download</button>
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
                                        <th>S.No./ क्रमांक</th>
                                        <th>District / ज़िला</th>
                                        <th>Sub-Division / अनुभाग</th>
                                        <th>Police Station / थाना/चौकी</th>
                                        <th>Important Arrest / गंभीर अपराधों में गिरफ्तारि / महत्वपूर्ण गिरफ्तारि</th>
                                        <th>Court's Decision / कोर्ट द्वारा दिए गये निर्णय (दोषमुक्त / सजा / जमानत /
                                            रद्द)</th>
                                        <th>Operation Muskaan आपरेशन मुस्कान / गुम इंसान दस्तायी</th>
                                        <th>Robbery Case / डकैती / लुट / चोरी का खुलासा</th>
                                        <th>Miscellaneous / विविध जैसे जन जागरुकता अभियान मे विशेष सफलता या प्राण
                                            रक्षा,गिरफ्तारी वारंटो
                                            की तमिलि आदि</th>
                                        <th>Section 102 / धारा 102 के तहत कि गई कार्यवाही</th>
                                    </thead>
                                    <?php $i = 1;
                                    foreach ($output_important_achievements as $impaction) {
                                        foreach ($impaction as $row) {
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
                                                    <?= $row['arrest_in_major_crime']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['decision_given_by_the_court']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['missing_man_document']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['robbery']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['miscellaneous']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['action_taken_under']; ?>
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
                <!-- Court Judgements TODO -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="alert alert-light" role="alert">
                                <strong>Court Judgements / महत्वपूर्ण कार्यवाही</strong>
                            </div>
                            <!-- Court Judgement download -->
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-12">
                                    <form action="../api/download.php" method="post" class="d-flex justify-content-end">
                                        <div class="p-2">
                                            <button type="submit" class="btn btn-primary" name="court_judgement_download">Download</button>
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
                                        <th>S.No./ क्रमांक</th>
                                        <th>District / ज़िला</th>
                                        <th>Sub-Division / अनुभाग</th>
                                        <th>Police Station / थाना/चौकी</th>
                                        <th>Name of Court / कोर्ट का नाम</th>
                                        <th>Crime Number / अपराध क्रमांक</th>
                                        <th>Section / धारा</th>
                                        <th>Result Date / कायमी दिनांक</th>
                                        <th>Name and Address of Culprit / आरोपी का नाम व पता</th>
                                        <th>Date / दिनांक</th>
                                        <th>Judgement / निर्णय</th>
                                    </thead>
                                    <?php $i = 1;
                                    foreach ($output_court_judgements as $cjudgements) {
                                        foreach ($cjudgements as $row) {
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
                                                    <?= $row['court_name']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['crime_number']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['penal_code']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['result_date']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['culprit_name']; ?> | <?= $row['culprit_address']; ?>
                                                </td>
                                                <td>
                                                    <?= (new DateTime($row['updated_at']))->format('Y-m-d'); ?>
                                                </td>
                                                <td>
                                                    <?= $row['judgement_of_court']; ?>
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