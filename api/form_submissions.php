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

    // Validate input fields
    $errors = array();
    if (empty($dead_body_number)) {
        $errors[] = "Dead Body Number is required.";
    }
    if (empty($penal_code)) {
        $errors[] = "Section Number is required.";
    }
    if (empty($accident_date)) {
        $errors[] = "Accident Date is required.";
    }
    if (empty($accident_place)) {
        $errors[] = "Accident Place is required.";
    }
    if (empty($information_date)) {
        $errors[] = "Information Date is required.";
    }
    if (empty($applicant_name)) {
        $errors[] = "Applicant Name is required.";
    }
    if (empty($deceased_name)) {
        $errors[] = "Deceased Name is required.";
    }
    if (empty($fir_writer)) {
        $errors[] = "Fir Writer Name is required.";
    }


    if (empty($errors)) {
        $query = "INSERT into dead_bodies (district, sub_division, police_station, dead_body_number, penal_code, accident_date, accident_place, information_date, information_time, applicant_name, deceased_name, fir_writer, cause_of_death, updated_by) VALUES ('$district', '$sub_division', '$police_station', '$dead_body_number', '$penal_code', '$accident_date', '$accident_place', '$information_date', '$information_time', '$applicant_name', '$deceased_name', '$fir_writer', '$cause_of_death', '$updated_by')";
        // echo $query;

        $query_run = mysqli_query($con, $query);
        if ($query_run) {

            $inserted_id = mysqli_insert_id($con);
            $user = $_SESSION['user-data']['user_id'];
            $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1,'$user','dead_bodies','$inserted_id','insert', 'Dead Body Data Filled.')";
            $log_query_run = mysqli_query($con, $log_query);

            $_SESSION['message'] = "Deadbody data Submitted successfully";
            // $_SESSION['message'] = $usertype ;
            $_SESSION['type'] = "success";
            if ($usertype === "admin") {
                header("Location: ../admin/dbf.php");
            } else {
                header("Location: ../user/dead_body_form.php");
            }
            exit(0);
        } else {
            $_SESSION['message'] = "Deadbody data submission failed";
            // $_SESSION['message'] = $usertype ;
            $_SESSION['type'] = "danger";
            if ($usertype == "admin") {
                header("Location: ../admin/dbf.php");
            } else {
                header("Location: ../user/dead_body_form.php");
            }

            exit(0);
        }
    } else {
        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";
        if ($usertype == "admin") {
            header("Location: ../admin/dbf.php");
        } else {
            header("Location: ../user/dead_body_form.php");
        }
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

    // Validate input fields
    $errors = array();
    if (empty($crime_number)) {
        $errors[] = "Crime Number is required.";
    }
    if (empty($penal_code)) {
        $errors[] = "Section Number is required.";
    }
    if (empty($reporting_date)) {
        $errors[] = "Report Date is required.";
    }
    if (empty($applicant_name)) {
        $errors[] = "Applicant Name is required.";
    }
    if (empty($applicant_address)) {
        $errors[] = "Applicant Address is required.";
    }
    if (empty($incident_place)) {
        $errors[] = "Incident Place is required.";
    }
    if (empty($incident_date)) {
        $errors[] = "Incident Date is required.";
    }
    if (empty($culprit_name)) {
        $errors[] = "Culprit Name is required.";
    }
    if (empty($culprit_address)) {
        $errors[] = "Culprit Address is required.";
    }
    if (empty($fir_writer)) {
        $errors[] = "Fir Writer Name is required.";
    }
    if (empty($arrest_date)) {
        $errors[] = "Arrest Date is required.";
    }
    if (empty($description_of_crime)) {
        $errors[] = "Description of Crime is required.";
    }
    if (empty($errors)) {
        $query = "INSERT into major_crimes (district, sub_division, police_station, crime_number, penal_code, incident_date, incident_time, incident_place, reporting_date, reporting_time, arrest_date, arrest_time, applicant_name, applicant_address, culprit_name, culprit_address, description_of_crime, is_major_crime, updated_by,  fir_writer, victim_name) VALUES ('$district', '$sub_division', '$police_station', '$crime_number', '$penal_code', '$incident_date', '$incident_time', '$incident_place', '$reporting_date', '$reporting_time', '$arrest_date', '$arrest_time', '$applicant_name', '$applicant_address', '$culprit_name', '$culprit_address', '$description_of_crime', '$is_major_crime', '$updated_by', '$fir_writer', '$victim_name')";

        // echo $query;

        $query_run = mysqli_query($con, $query);
        if ($query_run) {

            $inserted_id = mysqli_insert_id($con);
            $user = $_SESSION['user-data']['user_id'];
            $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1,'$user','major_crimes','$inserted_id','insert', 'Major Crime  Data Filled.')";
            $log_query_run = mysqli_query($con, $log_query);

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
    } else {
        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";
        if ($usertype == "admin") {
            header("Location: ../admin/mcf.php");
        } else {
            header("Location: ../user/major_crime_form.php");
        }
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

    // Validate input fields
    $errors = array();
    if (empty($crime_number)) {
        $errors[] = "Crime Number is required.";
    }
    if (empty($penal_code)) {
        $errors[] = "Section Number is required.";
    }
    if (empty($report_date)) {
        $errors[] = "Report Date is required.";
    }
    if (empty($culprit_name)) {
        $errors[] = "Culprit Name is required.";
    }
    if (empty($fir_writer)) {
        $errors[] = "Fir Writer Name is required.";
    }

    if (empty($errors)) {

        $query = "INSERT into minor_crimes (district, sub_division, police_station, crime_number, penal_code, culprit_name, updated_by, fir_writer, time_date) VALUES ('$district', '$sub_division', '$police_station', '$crime_number', '$penal_code', '$culprit_name', '$updated_by', '$fir_writer', '$time_date')";

        // echo $query;

        $query_run = mysqli_query($con, $query);
        if ($query_run) {

            $inserted_id = mysqli_insert_id($con);
            $user = $_SESSION['user-data']['user_id'];
            $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1,'$user','minor_crimes','$inserted_id','insert', 'Minor Crime Data Filled.')";
            $log_query_run = mysqli_query($con, $log_query);

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
    } else {
        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";
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

    // Validate input fields
    $errors = array();
    if (empty($crime_number)) {
        $errors[] = "Crime Number is required.";
    }
    if (empty($penal_code)) {
        $errors[] = "Section Number is required.";
    }
    if (empty($name_of_court)) {
        $errors[] = "Court's Name is required.";
    }
    if (empty($culprit_name)) {
        $errors[] = "Culprit Name is required.";
    }
    if (empty($culprit_address)) {
        $errors[] = "Culprit Address is required.";
    }
    if (empty($fir_date)) {
        $errors[] = "FIR Date is required.";
    }

    if (empty($errors)) {

        $query = "INSERT into ongoing_cases ( `updated_by`,`district`, `sub_division`, `police_station`, `crime_number`, `penal_code`, `fir_date`, `culprit_name`, `case_status`, `name_of_court`, `culprit_address`, `judgement_of_court`) VALUES ('$updated_by','$district', '$sub_division', '$police_station', '$crime_number', '$penal_code', '$fir_date', '$culprit_name', '$case_status', '$name_of_court', '$culprit_address', '$judgement_of_court')";

        // echo $query;

        $query_run = mysqli_query($con, $query);
        if ($query_run) {

            $inserted_id = mysqli_insert_id($con);
            $user = $_SESSION['user-data']['user_id'];
            $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1,'$user','ongoing_cases','$inserted_id','insert', 'Ongoing Case Data Filled.')";
            $log_query_run = mysqli_query($con, $log_query);

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
    } else {
        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";
        if ($usertype == "admin") {
            header("Location: ../admin/ocf.php");
        } else {
            header("Location: ../user/ongoing_case_form.php");
        }
        exit(0);
    }
}

if (isset($_POST['add_police_station'])) {
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $sub_division = mysqli_real_escape_string($con, $_POST['sub_division']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);


    // Validate input fields
    $errors = array();
    if (empty($district)) {
        $errors[] = "District Name is required.";
    }

    if (empty($sub_division)) {
        $errors[] = "Sub-Divisions Name is required.";
    }

    if (empty($police_station)) {
        $errors[] = "Police Station Name is required.";
    }

    if (empty($errors)) {
        $query = "INSERT into police_stations (`police_station` ,`sub_division`,`district` ) VALUES ('$police_station','$sub_division', '$district')";

        $query_run = mysqli_query($con, $query);
        if ($query_run) {

            $inserted_id = mysqli_insert_id($con);
            $user = $_SESSION['user-data']['user_id'];
            $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1,'$user','police_stations','$inserted_id','insert', 'Police Station Added.')";
            $log_query_run = mysqli_query($con, $log_query);

            $_SESSION['message'] = "Police Station Data Submitted successfully";
            // $_SESSION['message'] = $usertype ;
            $_SESSION['type'] = "success";

            header("Location: ../admin/police_station.php");

            exit(0);
        } else {
            $_SESSION['message'] = "Police Station data submission failed";
            // $_SESSION['message'] = $usertype ;
            $_SESSION['type'] = "danger";
            header("Location: ../admin/police_station.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";

        header("Location: ../admin/police_station.php");
    }
}