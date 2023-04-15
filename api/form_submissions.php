<?php
session_start();
require "dbcon.php";
$usertype = $_SESSION['user-data']['user_type'];

if (isset($_POST['save_deadbody'])) {
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $sub_division = mysqli_real_escape_string($con, $_POST['sub_division']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);

    $dead_body_number = mysqli_real_escape_string($con, $_POST['dead_body_number']);
    $penal_code = mysqli_real_escape_string($con, $_POST['penal_code']);
    $accident_date = mysqli_real_escape_string($con, $_POST['accident_date']);
    $accident_place = mysqli_real_escape_string($con, $_POST['accident_place']);
    $information_date = mysqli_real_escape_string($con, $_POST['information_date']);
    $information_time = mysqli_real_escape_string($con, $_POST['information_time']);
    $applicant_name = mysqli_real_escape_string($con, $_POST['applicant_name']);
    $deceased_name = mysqli_real_escape_string($con, $_POST['deceased_name']);
    $fir_writer = mysqli_real_escape_string($con, $_POST['fir_writer']);
    $cause_of_death = mysqli_real_escape_string($con, $_POST['cause_of_death']);
    $updated_by = $_SESSION['user-data']['user_id'];

    $query = "INSERT into dead_bodies (district, sub_division, police_station, dead_body_number, penal_code, accident_date, accident_place, information_date, information_time, applicant_name, deceased_name, fir_writer, cause_of_death, updated_by) VALUES ('$district', '$sub_division', '$police_station', '$dead_body_number', '$penal_code', '$accident_date', '$accident_place', '$information_date', '$information_time', '$applicant_name', '$deceased_name', '$fir_writer', '$cause_of_death', '$updated_by')";
    // echo $query;

    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $_SESSION['message'] = "Deadbody data Submitted successfully";
        // $_SESSION['message'] = $usertype ;
        $_SESSION['type'] = "success";
        if($usertype === "admin"){
            header("Location: ../admin/dbf.php");
        }
        else{
            header("Location: ../user/dead_body_form.php");
        }
        exit(0);
    } else {
        $_SESSION['message'] = "Deadbody data submission failed";
        // $_SESSION['message'] = $usertype ;
        $_SESSION['type'] = "danger";
        if($usertype == "admin"){
            header("Location: ../admin/dbf.php");
        }
        else{
            header("Location: ../user/dead_body_form.php");
        }
        
        exit(0);
    }
}

if (isset($_POST['save_major_crime'])) {
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $sub_division = mysqli_real_escape_string($con, $_POST['sub_division']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);

    $crime_number = mysqli_real_escape_string($con, $_POST['crime_number']);
    $penal_code = mysqli_real_escape_string($con, $_POST['penal_code']);
    $incident_date = mysqli_real_escape_string($con, $_POST['incident_date']);
    $incident_time = mysqli_real_escape_string($con, $_POST['incident_time']);
    $incident_place = mysqli_real_escape_string($con, $_POST['incident_place']);
    $reporting_date = mysqli_real_escape_string($con, $_POST['reporting_date']);
    $reporting_time = mysqli_real_escape_string($con, $_POST['reporting_time']);
    $arrest_date = mysqli_real_escape_string($con, $_POST['arrest_date']);
    $arrest_time = mysqli_real_escape_string($con, $_POST['arrest_time']);
    $applicant_name = mysqli_real_escape_string($con, $_POST['applicant_name']);
    $applicant_address = mysqli_real_escape_string($con, $_POST['applicant_address']);
    $culprit_name = mysqli_real_escape_string($con, $_POST['culprit_name']);
    $victim_name = mysqli_real_escape_string($con, $_POST['victim_name']);
    $culprit_address = mysqli_real_escape_string($con, $_POST['culprit_address']);
    $fir_writer = mysqli_real_escape_string($con, $_POST['fir_writer']);
    $description_of_crime = mysqli_real_escape_string($con, $_POST['description_of_crime']);
    $is_major_crime = isset($_POST['is_major_crime']) ? 1 : 0;
    $updated_by = $_SESSION['user-data']['user_id'];

    $query = "INSERT into major_crimes (district, sub_division, police_station, crime_number, penal_code, incident_date, incident_time, incident_place, reporting_date, reporting_time, arrest_date, arrest_time, applicant_name, applicant_address, culprit_name, culprit_address, description_of_crime, is_major_crime, updated_by,  fir_writer, victim_name) VALUES ('$district', '$sub_division', '$police_station', '$crime_number', '$penal_code', '$incident_date', '$incident_time', '$incident_place', '$reporting_date', '$reporting_time', '$arrest_date', '$arrest_time', '$applicant_name', '$applicant_address', '$culprit_name', '$culprit_address', '$description_of_crime', '$is_major_crime', '$updated_by', '$fir_writer', '$victim_name')";

    echo $query;

    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $_SESSION['message'] = "Major Crime data Submitted successfully";
        $_SESSION['type'] = "success";
        if ($usertype == "admin") {
            header("Location: ../admin/mcf.php");
        } else {
            header("Location: ../user/major_crime_form.php");
        }

        exit(0);
    } else {
        $_SESSION['message'] = "Major Crime data submission failed";
        $_SESSION['type'] = "danger";
        if ($usertype == "admin") {
            header("Location: ../admin/mcf.php");
        } else {
            header("Location: ../user/major_crime_form.php");
        }

        exit(0);
    }
}
if (isset($_POST['save_minor_crime'])) {
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $sub_division = mysqli_real_escape_string($con, $_POST['sub_division']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);

    $crime_number = mysqli_real_escape_string($con, $_POST['crime_number']);
    $penal_code = mysqli_real_escape_string($con, $_POST['penal_code']);
    $report_date = mysqli_real_escape_string($con, $_POST['reporting_date']);
    $report_time = mysqli_real_escape_string($con, $_POST['reporting_time']);
    $culprit_name = mysqli_real_escape_string($con, $_POST['culprit_name']);
    $fir_writer = mysqli_real_escape_string($con, $_POST['fir_writer']);
    $updated_by = $_SESSION['user-data']['user_id'];
    $time_date = date('Y-m-d H:i:s', strtotime($_POST['reporting_date'] . ' ' . $_POST['reporting_time']));

    $query = "INSERT into minor_crimes (district, sub_division, police_station, crime_number, penal_code, culprit_name, updated_by, fir_writer, time_date) VALUES ('$district', '$sub_division', '$police_station', '$crime_number', '$penal_code', '$culprit_name', '$updated_by', '$fir_writer', '$time_date')";

    echo $query;

    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $_SESSION['message'] = "Minor Crime data Submitted successfully";
        $_SESSION['type'] = "success";
        if ($usertype == "admin") {
            header("Location: ../admin/micf.php");
        } else {
            header("Location: ../user/minor_crime_form.php");
        }

        exit(0);
    } else {
        $_SESSION['message'] = "Minor Crime data submission failed";
        $_SESSION['type'] = "danger";
        if ($usertype == "admin") {
            header("Location: ../admin/micf.php");
        } else {
            header("Location: ../user/minor_crime_form.php");
        }

        exit(0);
    }
}

if (isset($_POST['save_ongoing_case'])) {
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $sub_division = mysqli_real_escape_string($con, $_POST['sub_division']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);

    $crime_number = mysqli_real_escape_string($con, $_POST['crime_number']);
    $penal_code = mysqli_real_escape_string($con, $_POST['penal_code']);
    $fir_date = mysqli_real_escape_string($con, $_POST['fir_date']);
    $name_of_court = mysqli_real_escape_string($con, $_POST['name_of_court']);
    $culprit_name = mysqli_real_escape_string($con, $_POST['culprit_name']);
    $culprit_address = mysqli_real_escape_string($con, $_POST['culprit_address']);
    $case_status = mysqli_real_escape_string($con, $_POST['case_status']);
    $judgement_of_court = mysqli_real_escape_string($con, $_POST['judgement_of_court']);
    $updated_by = $_SESSION['user-data']['user_id'];

    $query = "INSERT into ongoing_cases ( `updated_by`,`district`, `sub_division`, `police_station`, `crime_number`, `penal_code`, `fir_date`, `culprit_name`, `case_status`, `name_of_court`, `culprit_address`, `judgement_of_court`) VALUES ('$updated_by','$district', '$sub_division', '$police_station', '$crime_number', '$penal_code', '$fir_date', '$culprit_name', '$case_status', '$name_of_court', '$culprit_address', '$judgement_of_court')";

    echo $query;

    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $_SESSION['message'] = "Ongoing Case data Submitted successfully";
        $_SESSION['type'] = "success";
        if ($usertype == "admin") {
            header("Location: ../admin/ocf.php");
        } else {
            header("Location: ../user/ongoing_case_form.php");
        }
        exit(0);
    } else {
        $_SESSION['message'] = "Ongoing Case data submission failed";
        $_SESSION['type'] = "danger";
        if ($usertype == "admin") {
            header("Location: ../admin/ocf.php");
        } else {
            header("Location: ../user/ongoing_case_form.php");
        }
        exit(0);
    }
}



?>