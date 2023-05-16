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



?>