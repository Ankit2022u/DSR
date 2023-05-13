<?php
session_start();
require "dbcon.php";
$usertype = $_SESSION['user-data']['user_type'];

// Save Deadbody
if (isset($_POST['save_deadbody'])) {
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $sub_division = mysqli_real_escape_string($con, $_POST['sub_division']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);

    $dead_body_number = mysqli_real_escape_string($con, $_POST['dead_body_number']);
    $penal_code = mysqli_real_escape_string($con, $_POST['penal_code']);
    $accident_date = mysqli_real_escape_string($con, $_POST['accident_date']);
    $accident_time = mysqli_real_escape_string($con, $_POST['accident_time']);
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
    if (empty($accident_time)) {
        $errors[] = "Accident Time is required.";
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
        // Prepare and bind parameters to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO dead_bodies (district, sub_division, police_station, dead_body_number, penal_code, accident_date, accident_time, accident_place, information_date, information_time, applicant_name, deceased_name, fir_writer, cause_of_death, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param("sssssssssssssss", $district, $sub_division, $police_station, $dead_body_number, $penal_code, $accident_date, $accident_time, $accident_place, $information_date, $information_time, $applicant_name, $deceased_name, $fir_writer, $cause_of_death, $updated_by);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $inserted_id = $stmt->insert_id;
            $user = $_SESSION['user-data']['user_id'];
            // Prepare and bind parameters for log query
            $log_query = $con->prepare("INSERT INTO logs (status, created_by, table_name, table_id, operation, log_desc) VALUES (?, ?, ?, ?, ?, ?)");
            $status = 1;
            $operation = 'insert';
            $log_desc = 'Dead Body Data Filled.';
            $table_name = 'dead_bodies';
            $log_query->bind_param("ssssss", $status, $user, $table_name, $inserted_id, $operation, $log_desc);
            $log_query->execute();

            $_SESSION['message'] = "Deadbody data submitted successfully";
            $_SESSION['type'] = "success";
            if ($usertype === "admin") {
                header("Location: ../admin/dbf.php");
            } else {
                header("Location: ../user/dead_body_form.php");
            }
            exit(0);
        } else {
            $_SESSION['message'] = "Deadbody data submission failed";
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


// Save court judgement
if (isset($_POST['save_court_judgement'])) {
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $sub_division = mysqli_real_escape_string($con, $_POST['sub_division']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);

    $crime_number = mysqli_real_escape_string($con, $_POST['crime_number']);
    $penal_code = mysqli_real_escape_string($con, $_POST['penal_code']);
    $result_date = mysqli_real_escape_string($con, $_POST['result_date']);
    $applicant_address = mysqli_real_escape_string($con, $_POST['applicant_address']);
    $applicant_name = mysqli_real_escape_string($con, $_POST['applicant_name']);
    $name_of_court = mysqli_real_escape_string($con, $_POST['name_of_court']);
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
    if (empty($result_date)) {
        $errors[] = "Result Date is required.";
    }
    if (empty($applicant_name)) {
        $errors[] = "Applicant Name is required.";
    }
    if (empty($applicant_address)) {
        $errors[] = "Applicant Address is required.";
    }
    if (empty($name_of_court)) {
        $errors[] = "Name of Court is required.";
    }
    if (empty($judgement_of_court)) {
        $errors[] = "Court Judgement is required.";
    }

    if (empty($errors)) {
        // Prepare and bind parameters to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO court_judgements (district, sub_division, police_station, crime_number, penal_code, result_date, applicant_address, applicant_name, judgement_of_court, court_name, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $district, $sub_division, $police_station, $crime_number, $penal_code, $result_date, $applicant_address, $applicant_name, $judgement_of_court, $name_of_court, $updated_by);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $inserted_id = $stmt->insert_id;
            $user = $_SESSION['user-data']['user_id'];
            // Prepare and bind parameters for log query
            $log_query = $con->prepare("INSERT INTO logs (status, created_by, table_name, table_id, operation, log_desc) VALUES (?, ?, ?, ?, ?, ?)");
            $status = 1;
            $operation = 'insert';
            $log_desc = 'Court Judgement Data Filled.';
            $table_name = 'court_judgements';
            $log_query->bind_param("ssssss", $status, $user, $table_name, $inserted_id, $operation, $log_desc);
            $log_query->execute();

            $_SESSION['message'] = "Court Judgement data submitted successfully";
            $_SESSION['type'] = "success";
            if ($usertype === "admin") {
                header("Location: ../admin/cjf.php");
            } else {
                header("Location: ../user/court_judgement_form.php");
            }
            exit(0);
        } else {
            $_SESSION['message'] = "Court Judgement data submission failed";
            $_SESSION['type'] = "danger";
            if ($usertype == "admin") {
                header("Location: ../admin/cjf.php");
            } else {
                header("Location: ../user/court_judgement_form.php");
            }
            exit(0);
        }
    } else {
        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";
        if ($usertype == "admin") {
            header("Location: ../admin/cjf.php");
        } else {
            header("Location: ../user/court_judgement_form.php");
        }
    }
}

// Save major crime
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
        $query = "INSERT into major_crimes (district, sub_division, police_station, crime_number, penal_code, incident_date, incident_time, incident_place, reporting_date, reporting_time, arrest_date, arrest_time, applicant_name, applicant_address, culprit_name, culprit_address, description_of_crime, is_major_crime, updated_by,  fir_writer, victim_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sssssssssssssssssssss", $district, $sub_division, $police_station, $crime_number, $penal_code, $incident_date, $incident_time, $incident_place, $reporting_date, $reporting_time, $arrest_date, $arrest_time, $applicant_name, $applicant_address, $culprit_name, $culprit_address, $description_of_crime, $is_major_crime, $updated_by, $fir_writer, $victim_name);
        $query_run = mysqli_stmt_execute($stmt);

        if ($query_run) {
            $inserted_id = mysqli_insert_id($con);
            $user = $_SESSION['user-data']['user_id'];
            $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1, ?, 'major_crimes', ?, 'insert', 'Major Crime  Data Filled.')";
            $log_stmt = mysqli_prepare($con, $log_query);
            mysqli_stmt_bind_param($log_stmt, "ss", $user, $inserted_id);
            mysqli_stmt_execute($log_stmt);

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

// Save Minor crime
if (isset($_POST['save_minor_crime'])) {
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $sub_division = mysqli_real_escape_string($con, $_POST['sub_division']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);

    $crime_number = mysqli_real_escape_string($con, $_POST['crime_number']);
    $penal_code = mysqli_real_escape_string($con, $_POST['penal_code']);
    $incident_date = mysqli_real_escape_string($con, $_POST['incident_date']);
    $incident_time = mysqli_real_escape_string($con, $_POST['incident_time']);
    $culprit_number = mysqli_real_escape_string($con, $_POST['culprit_number']);
    $fir_writer = mysqli_real_escape_string($con, $_POST['fir_writer']);
    $updated_by = $_SESSION['user-data']['user_id'];
    $time_date = date('Y-m-d H:i:s', strtotime($_POST['incident_date'] . ' ' . $_POST['incident_time']));

    // Validate input fields
    $errors = array();
    if (empty($crime_number)) {
        $errors[] = "Crime Number is required.";
    }
    if (empty($penal_code)) {
        $errors[] = "Section Number is required.";
    }
    if (empty($incident_date)) {
        $errors[] = "Incident Date is required.";
    }
    if (empty($culprit_number)) {
        $errors[] = "Number of Culprits is required.";
    }
    if (empty($fir_writer)) {
        $errors[] = "Fir Writer Name is required.";
    }

    if (empty($errors)) {
        // Prepare the SQL statement to avoid SQL injection
        $stmt = $con->prepare("INSERT INTO minor_crimes (district, sub_division, police_station, crime_number, penal_code, culprit_number, updated_by, fir_writer, time_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssisss", $district, $sub_division, $police_station, $crime_number, $penal_code, $culprit_number, $updated_by, $fir_writer, $time_date);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $inserted_id = $stmt->insert_id;
            $user = $_SESSION['user-data']['user_id'];
            $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1, ?, 'minor_crimes', ?, 'insert', 'Minor Crime Data Filled.')";

            // Prepare and execute the log query
            $log_stmt = $con->prepare($log_query);
            $log_stmt->bind_param("si", $user, $inserted_id);
            $log_stmt->execute();

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

// Save ongoing case
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
        // Prepare and bind the query with placeholders
        $query = "INSERT into ongoing_cases (`updated_by`,`district`, `sub_division`, `police_station`, `crime_number`, `penal_code`, `fir_date`, `culprit_name`, `case_status`, `name_of_court`, `culprit_address`, `judgement_of_court`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssssss", $updated_by, $district, $sub_division, $police_station, $crime_number, $penal_code, $fir_date, $culprit_name, $case_status, $name_of_court, $culprit_address, $judgement_of_court);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $inserted_id = mysqli_insert_id($con);
            $user = $_SESSION['user-data']['user_id'];
            $log_query = "INSERT INTO `logs`(`status`, `created_by`, `table_name`, `table_id`, `operation`, `log_desc`) VALUES (1, ?, 'ongoing_cases', ?, 'insert', 'Ongoing Case Data Filled.')";
            $log_stmt = mysqli_prepare($con, $log_query);
            mysqli_stmt_bind_param($log_stmt, "si", $user, $inserted_id);
            mysqli_stmt_execute($log_stmt);

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



// Add police station
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
        // Prepare the query using prepared statements to prevent SQL injection
        $query = "INSERT into police_stations (`police_station` ,`sub_division`,`district` ) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sss", $police_station, $sub_division, $district);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);

        if ($affected_rows > 0) {
            $inserted_id = mysqli_insert_id($con);
            $user = $_SESSION['user-data']['user_id'];
            $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1, ?, 'police_stations', ?, 'insert', 'Police Station Added.')";
            $stmt_log = mysqli_prepare($con, $log_query);
            mysqli_stmt_bind_param($stmt_log, "ss", $user, $inserted_id);
            mysqli_stmt_execute($stmt_log);
            mysqli_stmt_close($stmt_log);

            $_SESSION['message'] = "Police Station Data Submitted successfully";
            $_SESSION['type'] = "success";
            header("Location: ../admin/police_station.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Police Station data submission failed";
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


// Save Important Achievements 
if (isset($_POST['save_important_achievement'])) {
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $sub_division = mysqli_real_escape_string($con, $_POST['sub_division']);
    $police_station = mysqli_real_escape_string($con, $_POST['police_station']);
    $arrest_in_major_crime = mysqli_real_escape_string($con, $_POST['arrest_in_major_crime']);
    $decision_given_by_the_court = mysqli_real_escape_string($con, $_POST['decision_given_by_the_court']);
    $missing_man_document = mysqli_real_escape_string($con, $_POST['missing_man_document']);
    $miscellaneous = mysqli_real_escape_string($con, $_POST['miscellaneous']);
    $robbery = mysqli_real_escape_string($con, $_POST['robbery']);
    $action_taken_under = mysqli_real_escape_string($con, $_POST['action_taken_under']);
    $updated_by = $_SESSION['user-data']['user_id'];

    // Validate input fields
    $errors = array();
    if (empty($decision_given_by_the_court)) {
        $errors[] = "Court Decision is required.";
    }
    if (empty($action_taken_under)) {
        $errors[] = "Action Taken Under 102 is required.";
    }

    if (empty($errors)) {
    // Prepare and bind the query with placeholders
    $query = "INSERT INTO important_achievements (`updated_by`,`district`,`sub_division`, `police_station`, `arrest_in_major_crime`, `decision_given_by_the_court`, `missing_man_document`, `miscellaneous`, `robbery`, `action_taken_under`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);

    // Assuming all columns are of type string (s)
    mysqli_stmt_bind_param($stmt, "ssssssssss", $updated_by, $district, $sub_division, $police_station, $arrest_in_major_crime, $decision_given_by_the_court, $missing_man_document, $miscellaneous, $robbery, $action_taken_under);

    // Execute the prepared statement
    $result = mysqli_stmt_execute($stmt);


    if ($result) {
        $inserted_id = mysqli_insert_id($con);
        $user = $_SESSION['user-data']['user_id'];
        $log_query = "INSERT INTO `logs`(`status`, `created_by`, `table_name`, `table_id`, `operation`, `log_desc`) VALUES (1, ?, 'ongoing_cases', ?, 'insert', 'Important Achievement Data Filled.')";
        $log_stmt = mysqli_prepare($con, $log_query);
        mysqli_stmt_bind_param($log_stmt, "si", $user, $inserted_id);
        mysqli_stmt_execute($log_stmt);

        $_SESSION['message'] = "Important Achievement data Submitted successfully";
        $_SESSION['type'] = "success";
        if ($usertype == "admin") {
            header("Location: ../admin/iaf.php");
        } else {
            header("Location: ../user/important_achievements_form.php");
        }
        exit(0);
    } else {
        $_SESSION['message'] = "Important Action data submission failed";
        $_SESSION['type'] = "danger";
        if ($usertype == "admin") {
            header("Location: ../admin/iaf.php");
        } else {
            header("Location: ../user/important_achievements_form.php");
        }
        exit(0);
    }
    } else {
        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";
        if ($usertype == "admin") {
            header("Location: ../admin/iaf.php");
        } else {
            header("Location: ../user/important_achievements_form.php");
        }
        exit(0);
    }
}
