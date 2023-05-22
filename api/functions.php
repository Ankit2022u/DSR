<?php

require 'dbcon.php';

/**
 * Retrieves distinct sub-divisions based on district from the police_stations table.
 *
 * @param string $district The district for which to fetch sub-divisions.
 * @return array|false An array of sub-divisions on success, false on failure.
 */
function get_sub_divisions($district)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT DISTINCT sub_division FROM police_stations WHERE district = ?");
    $stmt->bind_param("s", $district);
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_all(MYSQLI_ASSOC);
    return $result;
}

/**
 * Retrieves distinct sub-divisions based on district from the police_stations table.
 * @return array|false An array of districts on success, false on failure.
 */
function get_districts()
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT DISTINCT district FROM police_stations");
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_all(MYSQLI_ASSOC);
    return $result;
}


/**
 * Retrieves police stations based on district and sub-division from the police_stations table.
 *
 * @param string $district The district for which to fetch police stations.
 * @param string $sub_division The sub-division for which to fetch police stations.
 * @return array|false An array of police stations on success, false on failure.
 */
function get_police_stations($district, $sub_division)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT police_station FROM police_stations WHERE district = ? AND sub_division = ?");
    $stmt->bind_param("ss", $district, $sub_division);
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_all(MYSQLI_ASSOC);
    return $result;
}


/**
 * Retrieves police station data based on district from the police_stations table.
 *
 * @param string $district The district for which to fetch police station data.
 * @return array|false An array of police station data on success, false on failure.
 */
function get_police_station($district)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT police_station FROM police_stations WHERE district = ?");
    $stmt->bind_param("s", $district);
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_all(MYSQLI_ASSOC);
    return $result;
}

/**
 * Retrieves the count of dead bodies from the dead_bodies table.
 *
 * @return int|false The count of dead bodies on success, false on failure.
 */
function count_dead_bodies()
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT COUNT(*) FROM dead_bodies");
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_array()[0];
    return $result;
}

/**
 * Retrieves the count of important achievements from the important_achievements table.
 *
 * @return int|false The count of important achievements on success, false on failure.
 */
function count_important_achievements()
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT COUNT(*) FROM important_achievements");
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_array()[0];
    return $result;
}

/**
 * Retrieves the count of court judgements from the court_judgements table.
 *
 * @return int|false The count of court judgements on success, false on failure.
 */
function count_court_judgements()
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT COUNT(*) FROM court_judgements");
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_array()[0];
    return $result;
}


/**
 * Retrieves the list of distinct police stations from the police_stations table.
 *
 * @return array|false The list of police stations on success, false on failure.
 */
function police_stations()
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT DISTINCT police_station FROM police_stations");
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_all(MYSQLI_ASSOC);
    return $result;
}

/**
 * Retrieves the list of distinct districts from the police_stations table.
 *
 * @return array|false The list of districts on success, false on failure.
 */
function districts()
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT DISTINCT district FROM police_stations");
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_all(MYSQLI_ASSOC);
    return $result;
}


/**
 * Retrieves minor crimes data from the minor_crimes table based on the provided district, start date, and end date.
 *
 * @param string $district The district for which to retrieve minor crimes data. Use "All" to retrieve data for all districts.
 * @param string $start The start date for the data retrieval (formatted as 'Y-m-d H:i:s').
 * @param string $end The end date for the data retrieval (formatted as 'Y-m-d H:i:s').
 *
 * @return array|false The minor crimes data on success, false on failure.
 */
function find_minor_crimes($district, $start, $end)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    if ($district != "All") {
        $stmt = $con->prepare("SELECT * FROM minor_crimes WHERE updated_at >= ? AND updated_at <= ? AND updated_by IN (SELECT user_id FROM users) AND district = ?");
        $stmt->bind_param("sss", $start, $end, $district);
    } else {
        $stmt = $con->prepare("SELECT * FROM minor_crimes WHERE updated_at >= ? AND updated_at <= ?");
        $stmt->bind_param("ss", $start, $end);
    }

    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_all(MYSQLI_ASSOC);
    return $result;
}


/**
 * Retrieves major crimes data from the major_crimes table based on the provided district, start date, and end date.
 *
 * @param string $district The district for which to retrieve major crimes data. Use "All" to retrieve data for all districts.
 * @param string $start The start date for the data retrieval (formatted as 'Y-m-d H:i:s').
 * @param string $end The end date for the data retrieval (formatted as 'Y-m-d H:i:s').
 *
 * @return array|false The major crimes data on success, false on failure.
 */
function find_major_crimes($district, $start, $end)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    if ($district != "All") {
        $stmt = $con->prepare("SELECT * FROM major_crimes WHERE updated_at >= ? AND updated_at <= ? AND updated_by IN (SELECT user_id FROM users) AND district = ?");
        $stmt->bind_param("sss", $start, $end, $district);
    } else {
        $stmt = $con->prepare("SELECT * FROM major_crimes WHERE updated_at >= ? AND updated_at <= ?");
        $stmt->bind_param("ss", $start, $end);
    }

    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_all(MYSQLI_ASSOC);
    return $result;
}



/**
 * Retrieves ongoing cases data from the ongoing_cases table based on the provided district, start date, and end date.
 *
 * @param string $district The district for which to retrieve ongoing cases data. Use "All" to retrieve data for all districts.
 * @param string $start The start date for the data retrieval (formatted as 'Y-m-d H:i:s').
 * @param string $end The end date for the data retrieval (formatted as 'Y-m-d H:i:s').
 *
 * @return array|false The ongoing cases data on success, false on failure.
 */
function find_ongoing_cases($district, $start, $end)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    if ($district != "All") {
        $stmt = $con->prepare("SELECT * FROM ongoing_cases WHERE updated_at >= ? AND updated_at <= ? AND updated_by IN (SELECT user_id FROM users) AND district = ?");
        $stmt->bind_param("sss", $start, $end, $district);
    } else {
        $stmt = $con->prepare("SELECT * FROM ongoing_cases WHERE updated_at >= ? AND updated_at <= ?");
        $stmt->bind_param("ss", $start, $end);
    }

    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_all(MYSQLI_ASSOC);
    return $result;
}


/**
 * Retrieves dead bodies data from the dead_bodies table based on the provided district, start date, and end date.
 *
 * @param string $district The district for which to retrieve dead bodies data. Use "All" to retrieve data for all districts.
 * @param string $start The start date for the data retrieval (formatted as 'Y-m-d H:i:s').
 * @param string $end The end date for the data retrieval (formatted as 'Y-m-d H:i:s').
 *
 * @return array|false The dead bodies data on success, false on failure.
 */
function find_dead_bodies($district, $start, $end)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    if ($district != "All") {
        $stmt = $con->prepare("SELECT * FROM dead_bodies WHERE updated_at >= ? AND updated_at <= ? AND updated_by IN (SELECT `user_id` FROM users) AND district = ?");
        $stmt->bind_param("sss", $start, $end, $district);
    } else {
        $stmt = $con->prepare("SELECT * FROM dead_bodies WHERE updated_at >= ? AND updated_at <= ?");
        $stmt->bind_param("ss", $start, $end);
    }

    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_all(MYSQLI_ASSOC);
    return $result;
}


/**
 * Retrieves dead bodies data from the dead_bodies table based on the provided district, start date, and end date.
 *
 * @param string $district The district for which to retrieve important achievements data. Use "All" to retrieve data for all districts.
 * @param string $start The start date for the data retrieval (formatted as 'Y-m-d H:i:s').
 * @param string $end The end date for the data retrieval (formatted as 'Y-m-d H:i:s').
 *
 * @return array|false The important achievement data on success, false on failure.
 */
function find_important_achievements($district, $start, $end)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    if ($district != "All") {
        $stmt = $con->prepare("SELECT * FROM important_achievements WHERE updated_at >= ? AND updated_at <= ? AND updated_by IN (SELECT `user_id` FROM users) AND district = ?");
        $stmt->bind_param("sss", $start, $end, $district);
    } else {
        $stmt = $con->prepare("SELECT * FROM important_achievements WHERE updated_at >= ? AND updated_at <= ?");
        $stmt->bind_param("ss", $start, $end);
    }

    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_all(MYSQLI_ASSOC);
    return $result;
}

/**
 * Retrieves dead bodies data from the dead_bodies table based on the provided district, start date, and end date.
 *
 * @param string $district The district for which to retrieve court judgement data. Use "All" to retrieve data for all districts.
 * @param string $start The start date for the data retrieval (formatted as 'Y-m-d H:i:s').
 * @param string $end The end date for the data retrieval (formatted as 'Y-m-d H:i:s').
 *
 * @return array|false The court judgement data on success, false on failure.
 */
function find_court_judgements($district, $start, $end)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    if ($district != "All") {
        $stmt = $con->prepare("SELECT * FROM court_judgements WHERE updated_at >= ? AND updated_at <= ? AND updated_by IN (SELECT `user_id` FROM users) AND district = ?");
        $stmt->bind_param("sss", $start, $end, $district);
    } else {
        $stmt = $con->prepare("SELECT * FROM court_judgements WHERE updated_at >= ? AND updated_at <= ?");
        $stmt->bind_param("ss", $start, $end);
    }

    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_all(MYSQLI_ASSOC);
    return $result;
}


/**
 * Retrieves the total count of major crimes from the major_crimes table.
 *
 * @return int|false The total count of major crimes on success, false on failure.
 */
function count_major_crimes()
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT COUNT(*) as total_count FROM major_crimes");
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_assoc();
    return $result['total_count'];
}



/**
 * Retrieves the total count of minor crimes from the minor_crimes table.
 *
 * @return int|false The total count of minor crimes on success, false on failure.
 */
function count_minor_crimes()
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT COUNT(*) as total_count FROM minor_crimes");
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_assoc();
    return $result['total_count'];
}



/**
 * Retrieves the total count of ongoing cases from the ongoing_cases table.
 *
 * @return int|false The total count of ongoing cases on success, false on failure.
 */
function count_ongoing_cases()
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT COUNT(*) as total_count FROM ongoing_cases");
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_assoc();
    return $result['total_count'];
}



/**
 * Retrieves the total count of police stations from the police_stations table.
 *
 * @return int|false The total count of police stations on success, false on failure.
 */
function count_police_stations()
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT COUNT(*) as total_count FROM police_stations");
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_assoc();
    return $result['total_count'];
}



/**
 * Retrieves the total count of users from the users table.
 *
 * @return int|false The total count of users on success, false on failure.
 */
function count_users()
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT COUNT(*) as total_count FROM users");
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_assoc();
    return $result['total_count'];
}


/**
 * Get time ago from a given date string.
 *
 * @param string $created_at The created date in string format.
 *
 * @return string The time ago description.
 */
function getTimeAgo($created_at)
{
    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = new DateTime();
    $createdAtDateTime = new DateTime($created_at);
    // $interval = $createdAtDateTime->diff($currentDateTime);
    $interval = $currentDateTime->diff($createdAtDateTime);


    if ($interval->y > 0) {
        return $interval->y . " years ago";
    } elseif ($interval->m > 0) {
        return $interval->m . " months ago";
    } elseif ($interval->d > 0) {
        return $interval->d . " days ago";
    } elseif ($interval->h > 0) {
        return $interval->h . " hours ago";
    } elseif ($interval->i > 0) {
        return $interval->i . " minutes ago";
    } else {
        return "a few seconds ago";
    }
}


/**
 * Get the data uploaded by the user as provided in the input.
 *
 * @param string $user_id The created date in string format.
 *
 * @return array|bool The time ago description.
 */
function get_user_uploads($user_id)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    $upload_results = array();
    $stmts = array(
        $con->prepare("SELECT * from dead_bodies where `updated_by` = ?"),
        $con->prepare("SELECT * from minor_crimes where `updated_by` = ?"),
        $con->prepare("SELECT * from major_crimes where `updated_by` = ?"),
        $con->prepare("SELECT * from ongoing_cases where `updated_by` = ?")
    );

    // Bind and execute each statement in a loop
    foreach ($stmts as $stmt) {
        $stmt->bind_param('s', $user_id);
        $stmt->execute();
        $query_run = $stmt->get_result();

        if (!$query_run) {
            // Query Failed
            // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
            echo "Error: " . $stmt->error;
            return false;
        }

        // Query Success
        $result = $query_run->fetch_assoc();
        $upload_results[] = $result;
    }

    return $upload_results;
}

function get_acts_count($start_date, $end_date, $act, $police_station)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT COUNT(*) as case_count, SUM(culprit_number) as people_count FROM minor_crimes where updated_at >= ? and updated_at <= ? and penal_code = ? and police_station = ?");
    $stmt->bind_param('ssss', $start_date, $end_date, $act, $police_station);
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_assoc();
    return $result;
}

// Funtions for pdf downloads
function get_semidata($date, $district)
{
    $conn = new mysqli('localhost', 'username', 'password', 'database_name');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $tables = array(
        'major_crimes',
        'dead_bodies',
        'important_achievements',
        'court_judgements'
    );

    $data = array();

    foreach ($tables as $table) {
        $query = "SELECT * FROM $table WHERE date = '$date' AND district = '$district'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $records = array();
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
            $data[$table] = $records;
        } else {
            $data[$table] = array();
        }
    }

    $conn->close();

    return $data;
}

function get_act_count_by_police_station($date, $act, $police_station)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT COUNT(*) as case_count, SUM(culprit_number) as people_count FROM minor_crimes WHERE DATE(updated_at) = ? AND penal_code = ? AND police_station = ?");
    $stmt->bind_param('sss', $date, $act, $police_station);
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_assoc();
    return $result;
}

function get_act_count_by_district($date, $act, $district)
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $con->prepare("SELECT COUNT(*) as case_count, SUM(culprit_number) as people_count FROM minor_crimes WHERE DATE(updated_at) = ? AND penal_code = ? AND district = ?");
    $stmt->bind_param('sss', $date, $act, $district);
    $stmt->execute();
    $query_run = $stmt->get_result();

    if (!$query_run) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Query Success
    $result = $query_run->fetch_assoc();
    return $result;
}

/**
 * Retrieve the penal codes from the penal_codes table based on the specified type.
 * If "all" is given as the type, it retrieves all penal codes.
 *
 * @param string $type The type of penal codes to retrieve. Use "all" to retrieve all penal codes.
 * @return array An array containing the penal codes based on the specified type.
 */
function get_penal_codes(string $type): array {
    global $con; // Note: Consider passing $con as a parameter instead of using global

    $query = "SELECT * FROM penal_codes";
    if ($type !== 'all') {
        $type = $con->real_escape_string($type);
        $query .= " WHERE type = '$type'";
    }

    $result = [];
    $penal_codes = $con->query($query);
    if ($penal_codes && $penal_codes->num_rows > 0) {
        while ($row = $penal_codes->fetch_assoc()) {
            $result[] = $row;
        }
    }

    return $result;
}


/**
 * Retrieve the count of minor crimes, categorized by district, police station, and penal code, for a specific date.
 *
 * @param string $date The date for which to retrieve the crime data.
 * @return array An array containing the count of cases and people for each district, police station, and penal code.
 */
function get_minor_crimes(string $date): array {
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Retrieve penal codes
    $penal_codes = get_penal_codes("minor");

    // Retrieve districts
    $districts = get_districts();

    // Count cases and people for each district, police station, and penal code
    $result = [];
    foreach ($districts as $district) {
        foreach ($penal_codes as $penal_code) {
            $district_result = get_act_count_by_district($date, $penal_code, $district['district']);
            $police_stations = get_police_stations($district['district'], "Option1"); // Retrieve police stations for the district

            foreach ($police_stations as $police_station) {
                $police_station_name = $police_station['police_station'];
                $police_station_result = get_act_count_by_police_station($date, $penal_code, $police_station_name);

                $result[$district['district']][$police_station_name][$penal_code] = [
                    'case_count' => $police_station_result['case_count'],
                    'people_count' => $police_station_result['people_count']
                ];
            }
            $result[$district['district']]['योग'][$penal_code] = [
                'case_count' => $district_result['case_count'],
                'people_count' => $district_result['people_count'],
            ];
        }
    }

    return $result;
}

/**
 * Counts the number of murder cases within a specific date and district.
 *
 * @param string $date The date for which murder cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the murder cases occurred.
 * @return int|false The count of murder cases, or false if the query fails.
 */
function count_murder_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count murder cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE type = 'IPC-Murder'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}

/**
 * Counts the number of gangrape cases within a specific date and district.
 *
 * @param string $date The date for which gangrape cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the gangrape cases occurred.
 * @return int|false The count of gangrape cases, or false if the query fails.
 */
function count_gangrape_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count gangrape cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE type = 'IPC-Gangrape'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}

/**
 * Counts the number of rape cases within a specific date and district.
 *
 * @param string $date The date for which rape cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the rape cases occurred.
 * @return int|false The count of rape cases, or false if the query fails.
 */
function count_rape_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count gangrape cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE type = 'IPC-Rape'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}

/**
 * Counts the number of ipc 363 cases within a specific date and district.
 *
 * @param string $date The date for which ipc 363 cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the ipc 363 cases occurred.
 * @return int|false The count of ipc 363 cases, or false if the query fails.
 */
function count_ipc_363_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count gangrape cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE penal_code = '363'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}

/**
 * Counts the number of robbery cases within a specific date and district.
 *
 * @param string $date The date for which robbery cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the robbery cases occurred.
 * @return int|false The count of robbery cases, or false if the query fails.
 */
function count_robbery_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count gangrape cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE type = 'IPC-Robbery'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}
/**
 * Counts the number of dacoity cases within a specific date and district.
 *
 * @param string $date The date for which dacoity cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the dacoity cases occurred.
 * @return int|false The count of dacoity cases, or false if the query fails.
 */
function count_dacoity_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count gangrape cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE type = 'IPC-Dacoity'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}

/**
 * Counts the number of kidnap for ransom cases within a specific date and district.
 *
 * @param string $date The date for which kidnap for ransom  cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the kidnap for ransom cases occurred.
 * @return int|false The count of kidnap for ransom cases, or false if the query fails.
 */
function count_kidnap_for_ransom_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count gangrape cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE type = 'IPC-Kidnapforransom'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}

/**
 * Counts the number of abkari act cases within a specific date and district.
 *
 * @param string $date The date for which abkari act cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the abkari act cases occurred.
 * @return int|false The count of abkari act cases, or false if the query fails.
 */
function count_abkari_act_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count gangrape cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE penal_code = 'आब. एक्ट'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}

/**
 * Counts the number of jua act cases within a specific date and district.
 *
 * @param string $date The date for which jua act cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the jua act cases occurred.
 * @return int|false The count of jua act cases, or false if the query fails.
 */
function count_jua_act_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count gangrape cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE penal_code = 'जुआ एक्ट'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}

/**
 * Counts the number of narcotics cases within a specific date and district.
 *
 * @param string $date The date for which narcotics cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the narcotics cases occurred.
 * @return int|false The count of narcotics cases, or false if the query fails.
 */
function count_narcotics_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count gangrape cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE penal_code = 'नारको'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}

/**
 * Counts the number of arms act cases within a specific date and district.
 *
 * @param string $date The date for which arms act cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the arms act cases occurred.
 * @return int|false The count of arms act cases, or false if the query fails.
 */
function count_arms_act_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count gangrape cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE penal_code = 'आर्म्स. एक्ट'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}

/**
 * Counts the number of satta cases within a specific date and district.
 *
 * @param string $date The date for which satta cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the satta cases occurred.
 * @return int|false The count of satta cases, or false if the query fails.
 */
function count_satta_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count gangrape cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE penal_code = 'सट्टा'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}

/**
 * Counts the number of mv act cases within a specific date and district.
 *
 * @param string $date The date for which mv act cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the mv act cases occurred.
 * @return int|false The count of mv act cases, or false if the query fails.
 */
function count_mv_act_cases(string $date, string $district): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count gangrape cases
    $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(date) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE penal_code = 'एम. वी. एक्ट'
              )";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $date, $district);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if (!$result) {
        // Query Failed
        // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
        echo "Error: " . $stmt->error;
        return false;
    }

    // Fetch the result
    $row = $result->fetch_assoc();
    $case_count = $row['case_count'];

    return $case_count;
}

?>