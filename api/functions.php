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
// function get_semidata($date, $district)
// {
//     global $con;
//     $tables = array(
//         'major_crimes',
//         'dead_bodies',
//         'important_achievements',
//         'court_judgements'
//     );

//     $data = array();

//     foreach ($tables as $table) {
//         $query = "SELECT * FROM $table WHERE date = '$date' AND district = '$district'";
//         $result = $con->query($query);

//         if ($result->num_rows > 0) {
//             $records = array();
//             while ($row = $result->fetch_assoc()) {
//                 $records[] = $row;
//             }
//             $data[$table] = $records;
//         } else {
//             $data[$table] = array();
//         }
//     }

//     return $data;
// }

/**
 * Get data from the 'court_judgements' table for a specific date and district.
 *
 * @param string $date The date for which to retrieve the data.
 * @param string $district The district for which to retrieve the data.
 * @return array The records from the 'court_judgements' table.
 */
function get_court_judgements(string $date, string $district): array
{
    global $con;
    if ($district == "All") { // Use '==' for comparison, not '='
        $query = "SELECT * FROM court_judgements WHERE DATE(created_at) = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $date);
    } else {
        $query = "SELECT * FROM court_judgements WHERE DATE(created_at) = ? AND district = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $date, $district);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
        return $records;
    } else {
        return [];
    }
}


/**
 * Get data from the 'important_achievements' table for a specific date and district.
 *
 * @param string $date The date for which to retrieve the data.
 * @param string $district The district for which to retrieve the data.
 * @return array The records from the 'important_achievements' table.
 */
function get_important_achievements(string $date, string $district): array
{
    global $con;
    if ($district == "All") { // Use '==' for comparison, not '='
        $query = "SELECT * FROM important_achievements WHERE DATE(created_at) = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $date);
    } else {
        $query = "SELECT * FROM important_achievements WHERE DATE(created_at) = ? AND district = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $date, $district);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
        return $records;
    } else {
        return [];
    }
}


/**
 * Get data from the 'dead_bodies' table for a specific date and district.
 *
 * @param string $date The date for which to retrieve the data.
 * @param string $district The district for which to retrieve the data.
 * @return array The records from the 'dead_bodies' table.
 */
function get_dead_bodies(string $date, string $district): array
{
    global $con;
    if ($district == "All") { // Use '==' for comparison, not '='
        $query = "SELECT * FROM dead_bodies WHERE DATE(created_at) = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $date);
    } else {
        $query = "SELECT * FROM dead_bodies WHERE DATE(created_at) = ? AND district = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $date, $district);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
        return $records;
    } else {
        return [];
    }
}


/**
 * Get data from the 'major_crimes' table for a specific date and district.
 *
 * @param string $date The date for which to retrieve the data.
 * @param string $district The district for which to retrieve the data.
 * @return array The records from the 'major_crimes' table.
 */
function get_major_crimes(string $date, string $district): array
{
    global $con;
    if ($district == "All") { // Use '==' for comparison, not '='
        $query = "SELECT * FROM major_crimes WHERE DATE(created_at) = ? AND is_major_crime = 1";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $date);
    } else {
        $query = "SELECT * FROM major_crimes WHERE DATE(created_at) = ? AND district = ? AND is_major_crime = 1";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $date, $district);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
        return $records;
    } else {
        return [];
    }
}


/**
 * Get data from the 'crimes' table for a specific date and district.
 *
 * @param string $date The date for which to retrieve the data.
 * @param string $district The district for which to retrieve the data.
 * @return array The records from the 'crimes' table.
 */
function get_crimes(string $date, string $district): array
{
    global $con;
    if ($district == "All") { // Use '==' for comparison, not '='
        $query = "SELECT * FROM major_crimes WHERE DATE(created_at) = ? AND is_major_crime = 0";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $date);
    } else {
        $query = "SELECT * FROM major_crimes WHERE DATE(created_at) = ? AND district = ? AND is_major_crime = 0";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $date, $district);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
        return $records;
    } else {
        return [];
    }
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
function get_penal_codes(string $type): array
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    $query = "SELECT * FROM penal_codes";
    if ($type !== 'All') {
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
 * @param string $district The district for which to retrieve the crime data.
 * @return array An array containing the count of cases and people for each district, police station, and penal code.
 */
function get_minor_crimes(string $date, $dist): array
{
    global $con; // Note: Consider passing $con as a parameter instead of using global

    // Retrieve penal codes
    $penal_codes1 = get_penal_codes("Restricted");
    $penal_codes2 = get_penal_codes("Minor-Act");
    $penal_codes = array_merge($penal_codes1, $penal_codes2);

    // Retrieve districts
    if ($dist == "All") {
        $districts = get_districts();
    } else {
        $distt['district'] = $dist;
        $districts = [$distt];
    }

    // Count cases and people for each district, police station, and penal code
    $result = [];
    foreach ($districts as $district) {
        foreach ($penal_codes as $penal_code) {
            $district_result = get_act_count_by_district($date, $penal_code['penal_code'], $district['district']);
            $police_stations = get_police_stations($district['district'], "Option1"); // Retrieve police stations for the district

            foreach ($police_stations as $police_station) {
                $police_station_name = $police_station['police_station'];
                $police_station_result = get_act_count_by_police_station($date, $penal_code['penal_code'], $police_station_name);

                $result[$district['district']][$police_station_name][$penal_code['penal_code']] = [
                    'case_count' => $police_station_result['case_count'],
                    'people_count' => $police_station_result['people_count']
                ];
            }
            $result[$district['district']]['योग'][$penal_code['penal_code']] = [
                'case_count' => $district_result['case_count'],
                'people_count' => $district_result['people_count'],
            ];
        }
    }
    // echo"<pre>";
    // print_r($result);
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
    if ($district = "All") {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(created_at) = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE type = 'IPC-Murder'
              )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $date);
    } else {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(created_at) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE type = 'IPC-Murder'
              )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ss', $date, $district);
    }

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
    if ($district !== "All") {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
                  WHERE DATE(created_at) = ? AND district = ? AND penal_code IN (
                      SELECT penal_code FROM penal_codes WHERE type = 'IPC-Gangrape'
                  )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ss', $date, $district);
    } else {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(created_at) = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE type = 'IPC-Gangrape'
              )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $date);
    }

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
    if ($district !== "All") {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
                  WHERE DATE(created_at) = ? AND district = ? AND penal_code IN (
                      SELECT penal_code FROM penal_codes WHERE type = 'IPC-Rape'
                  )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ss', $date, $district);
    } else {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
                  WHERE DATE(created_at) = ? AND penal_code IN (
                      SELECT penal_code FROM penal_codes WHERE type = 'IPC-Rape'
                  )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $date);
    }

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
    if ($district !== "All") {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(created_at) = ? AND district = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE penal_code = '363'
              )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ss', $date, $district);
    } else {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
              WHERE DATE(created_at) = ? AND penal_code IN (
                  SELECT penal_code FROM penal_codes WHERE penal_code = '363'
              )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $date);
    }
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
    if ($district !== "All") {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
                  WHERE DATE(created_at) = ? AND district = ? AND penal_code IN (
                      SELECT penal_code FROM penal_codes WHERE type = 'IPC-Robbery'
                  )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ss', $date, $district);
    } else {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
                  WHERE DATE(created_at) = ? AND penal_code IN (
                      SELECT penal_code FROM penal_codes WHERE type = 'IPC-Robbery'
                  )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $date);
    }
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
    if ($district !== "All") {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
                  WHERE DATE(created_at) = ? AND district = ? AND penal_code IN (
                      SELECT penal_code FROM penal_codes WHERE type = 'IPC-Dacoity'
                  )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ss', $date, $district);
    } else {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
                  WHERE DATE(created_at) = ? AND penal_code IN (
                      SELECT penal_code FROM penal_codes WHERE type = 'IPC-Dacoity'
                  )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $date);
    }
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
    if ($district !== "All") {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
                  WHERE DATE(created_at) = ? AND district = ? AND penal_code IN (
                      SELECT penal_code FROM penal_codes WHERE type = 'IPC-Kidnapforransom'
                  )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ss', $date, $district);
    } else {
        $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
                  WHERE DATE(created_at) = ? AND penal_code IN (
                      SELECT penal_code FROM penal_codes WHERE type = 'IPC-Kidnapforransom'
                  )";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $date);
    }
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

// /**
//  * Counts the number of abkari act cases within a specific date and district.
//  *
//  * @param string $date The date for which abkari act cases are counted (YYYY-MM-DD format).
//  * @param string $district The district in which the abkari act cases occurred.
//  * @return int|false The count of abkari act cases, or false if the query fails.
//  */
// function count_abkari_act_cases(string $date, string $district): int|false
// {
//     // Connect to the database
//     global $con;

//     // Prepare and execute the query to count gangrape cases
//     $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
//               WHERE DATE(date) = ? AND district = ? AND penal_code IN (
//                   SELECT penal_code FROM penal_codes WHERE penal_code = 'आब. एक्ट'
//               )";
//     $stmt = $con->prepare($query);
//     $stmt->bind_param('ss', $date, $district);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     // Check if query execution was successful
//     if (!$result) {
//         // Query Failed
//         // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
//         echo "Error: " . $stmt->error;
//         return false;
//     }

//     // Fetch the result
//     $row = $result->fetch_assoc();
//     $case_count = $row['case_count'];

//     return $case_count;
// }

// /**
//  * Counts the number of jua act cases within a specific date and district.
//  *
//  * @param string $date The date for which jua act cases are counted (YYYY-MM-DD format).
//  * @param string $district The district in which the jua act cases occurred.
//  * @return int|false The count of jua act cases, or false if the query fails.
//  */
// function count_jua_act_cases(string $date, string $district): int|false
// {
//     // Connect to the database
//     global $con;

//     // Prepare and execute the query to count gangrape cases
//     $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
//               WHERE DATE(date) = ? AND district = ? AND penal_code IN (
//                   SELECT penal_code FROM penal_codes WHERE penal_code = 'जुआ एक्ट'
//               )";
//     $stmt = $con->prepare($query);
//     $stmt->bind_param('ss', $date, $district);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     // Check if query execution was successful
//     if (!$result) {
//         // Query Failed
//         // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
//         echo "Error: " . $stmt->error;
//         return false;
//     }

//     // Fetch the result
//     $row = $result->fetch_assoc();
//     $case_count = $row['case_count'];

//     return $case_count;
// }

// /**
//  * Counts the number of narcotics cases within a specific date and district.
//  *
//  * @param string $date The date for which narcotics cases are counted (YYYY-MM-DD format).
//  * @param string $district The district in which the narcotics cases occurred.
//  * @return int|false The count of narcotics cases, or false if the query fails.
//  */
// function count_narcotics_cases(string $date, string $district): int|false
// {
//     // Connect to the database
//     global $con;

//     // Prepare and execute the query to count gangrape cases
//     $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
//               WHERE DATE(date) = ? AND district = ? AND penal_code IN (
//                   SELECT penal_code FROM penal_codes WHERE penal_code = 'नारको'
//               )";
//     $stmt = $con->prepare($query);
//     $stmt->bind_param('ss', $date, $district);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     // Check if query execution was successful
//     if (!$result) {
//         // Query Failed
//         // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
//         echo "Error: " . $stmt->error;
//         return false;
//     }

//     // Fetch the result
//     $row = $result->fetch_assoc();
//     $case_count = $row['case_count'];

//     return $case_count;
// }

// /**
//  * Counts the number of arms act cases within a specific date and district.
//  *
//  * @param string $date The date for which arms act cases are counted (YYYY-MM-DD format).
//  * @param string $district The district in which the arms act cases occurred.
//  * @return int|false The count of arms act cases, or false if the query fails.
//  */
// function count_arms_act_cases(string $date, string $district): int|false
// {
//     // Connect to the database
//     global $con;

//     // Prepare and execute the query to count gangrape cases
//     $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
//               WHERE DATE(date) = ? AND district = ? AND penal_code IN (
//                   SELECT penal_code FROM penal_codes WHERE penal_code = 'आर्म्स. एक्ट'
//               )";
//     $stmt = $con->prepare($query);
//     $stmt->bind_param('ss', $date, $district);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     // Check if query execution was successful
//     if (!$result) {
//         // Query Failed
//         // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
//         echo "Error: " . $stmt->error;
//         return false;
//     }

//     // Fetch the result
//     $row = $result->fetch_assoc();
//     $case_count = $row['case_count'];

//     return $case_count;
// }

// /**
//  * Counts the number of satta cases within a specific date and district.
//  *
//  * @param string $date The date for which satta cases are counted (YYYY-MM-DD format).
//  * @param string $district The district in which the satta cases occurred.
//  * @return int|false The count of satta cases, or false if the query fails.
//  */
// function count_satta_cases(string $date, string $district): int|false
// {
//     // Connect to the database
//     global $con;

//     // Prepare and execute the query to count gangrape cases
//     $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
//               WHERE DATE(date) = ? AND district = ? AND penal_code IN (
//                   SELECT penal_code FROM penal_codes WHERE penal_code = 'सट्टा'
//               )";
//     $stmt = $con->prepare($query);
//     $stmt->bind_param('ss', $date, $district);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     // Check if query execution was successful
//     if (!$result) {
//         // Query Failed
//         // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
//         echo "Error: " . $stmt->error;
//         return false;
//     }

//     // Fetch the result
//     $row = $result->fetch_assoc();
//     $case_count = $row['case_count'];

//     return $case_count;
// }

// /**
//  * Counts the number of mv act cases within a specific date and district.
//  *
//  * @param string $date The date for which mv act cases are counted (YYYY-MM-DD format).
//  * @param string $district The district in which the mv act cases occurred.
//  * @return int|false The count of mv act cases, or false if the query fails.
//  */
// function count_mv_act_cases(string $date, string $district): int|false
// {
//     // Connect to the database
//     global $con;

//     // Prepare and execute the query to count gangrape cases
//     $query = "SELECT COUNT(*) AS case_count FROM major_crimes 
//               WHERE DATE(date) = ? AND district = ? AND penal_code IN (
//                   SELECT penal_code FROM penal_codes WHERE penal_code = 'एम. वी. एक्ट'
//               )";
//     $stmt = $con->prepare($query);
//     $stmt->bind_param('ss', $date, $district);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     // Check if query execution was successful
//     if (!$result) {
//         // Query Failed
//         // Note: Consider logging the error instead of echoing it to prevent exposing sensitive information
//         echo "Error: " . $stmt->error;
//         return false;
//     }

//     // Fetch the result
//     $row = $result->fetch_assoc();
//     $case_count = $row['case_count'];

//     return $case_count;
// }

/**
 * Counts the number of cases within a specific date, district, and penal code.
 *
 * @param string $date The date for which cases are counted (YYYY-MM-DD format).
 * @param string $district The district in which the cases occurred.
 * @param string $penal_code The penal code for which cases are counted.
 * @return int|false The count of cases, or false if the query fails.
 */
function count_cases(string $date, string $district, string $penal_code): int|false
{
    // Connect to the database
    global $con;

    // Prepare and execute the query to count cases
    if ($district !== "All") {
        $query = "SELECT COUNT(*) AS case_count FROM minor_crimes
              WHERE DATE(created_at) = ? AND district = ? AND penal_code = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('sss', $date, $district, $penal_code);
    } else {
        $query = "SELECT COUNT(*) AS case_count FROM minor_crimes
              WHERE DATE(created_at) = ? AND penal_code = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ss', $date, $penal_code);
    }
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
 * Sums the elements of an array and returns the total sum.
 *
 * @param array $numbers The array of numbers to be summed.
 * @return int|float The total sum of the numbers.
 */
function sum_elements(array $numbers): int|float
{
    $sum = 0;

    foreach ($numbers as $number) {
        $sum += $number;
    }

    return $sum;
}

/**
 * Get the next date based on the given date, including handling leap years.
 *
 * @param string $date The date for which to calculate the next date (YYYY-MM-DD format).
 * @return string|false The next date in YYYY-MM-DD format, or false if the input date is invalid.
 */
function get_next_date(string $date): string|false
{
    $currentDate = DateTime::createFromFormat('Y-m-d', $date);

    if (!$currentDate) {
        // Invalid input date
        return false;
    }

    $currentDate->modify('+1 day');

    return $currentDate->format('Y-m-d');
}

/**
 * Retrieve the count of rows from a specific table where disposal_date matches the given date for a specific district.
 *
 * @param string $date The date to match for disposal_date.
 * @param string $district The district for which to retrieve the count.
 * @param string $type The type of table to query ('crime' or 'deadbody').
 * @return int The count of rows matching the criteria.
 */
function get_disposals(string $date, string $district, string $type): array
{
    global $con;
    $table = '';

    if ($type == 'crime') {
        $table = 'major_crimes';
    } elseif ($type == 'deadbody') {
        $table = 'dead_bodies';
    }
    if ($district !== "All") {
        $query = "SELECT COUNT(*) as count FROM $table WHERE disposal_date = ? AND district = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $date, $district);
    } else {
        $query = "SELECT COUNT(*) as count FROM $table WHERE disposal_date = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $date);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];

    $query = "SELECT police_station FROM police_stations WHERE district = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $district);
    $stmt->execute();
    $result = $stmt->get_result();
    $police_stations = array();
    while ($row = $result->fetch_assoc()) {
        $police_stations[] = $row['police_station'];
    }

    $disposals = array();
    foreach ($police_stations as $police_station) {
        $query = "SELECT COUNT(*) as count FROM $table WHERE disposal_date = ? AND district = ? AND police_station = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("sss", $date, $district, $police_station);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $disposals[$police_station] = $row['count'];
    }

    return $disposals;
}


/**
 * Retrieve the count of rows from a specific table where disposal_date matches the given date for a specific district.
 *
 * @param string $date The date to match for disposal_date.
 * @param string $district The district for which to retrieve the count.
 * @param string $type The type of table to query ('crime' or 'deadbody').
 * @return int The count of rows matching the criteria.
 */
/**
 * Get the count of disposals up to the same year for every police station in the district.
 *
 * @param string $date The disposal date.
 * @param string $district The district.
 * @param string $type The type of disposal.
 * @return array An associative array where the keys are police stations and the values are the count of disposals.
 */
function get_old_disposals(string $date, string $district, string $type): array
{
    global $con;
    $table = '';

    if ($type == 'crime') {
        $table = 'major_crimes';
    } elseif ($type == 'deadbody') {
        $table = 'dead_bodies';
    }
    if ($district !== "All") {
        $query = "SELECT COUNT(*) as count FROM $table WHERE disposal_date < ? AND district = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $date, $district);
    } else {
        $query = "SELECT COUNT(*) as count FROM $table WHERE disposal_date < ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $date);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];

    $query = "SELECT police_station FROM police_stations WHERE district = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $district);
    $stmt->execute();
    $result = $stmt->get_result();
    $police_stations = array();
    while ($row = $result->fetch_assoc()) {
        $police_stations[] = $row['police_station'];
    }

    $disposals = array();
    foreach ($police_stations as $police_station) {
        $query = "SELECT COUNT(*) as count FROM $table WHERE disposal_date < ? AND district = ? AND police_station = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("sss", $date, $district, $police_station);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $disposals[$police_station] = $row['count'];
    }

    return $disposals;
}

function generateCourtJudgementsExcel($date, $district)
{
    $html = "<table style='vertical-align:middle;'>";
    $html .= "<tr>
                    <th colspan=9 center style='font-size: 40px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:75;'>कोर्ट के निर्णय | $date </th>
                </tr>
                <tr style='height:100px'>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:45px;'>क्र.</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:200px;'>थाना/चौकी</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:250px;'>कोर्ट का नाम</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:100px'>अप. क्र.</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:250px;'>धारा</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:200px;'>कायमी दिनांक</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:330px;'>आरोपी का नाम व पता</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:135px;'>दिनांक</th>
                    <th style='font-size: 28px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:200px;'>निर्णय</th>
                </tr>";
    $i = 0;
    $found_judgements = false;
    foreach (get_court_judgements($date, $district) as $row) {
        $found_judgements = true;
        $html .= "<tr>
                        <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $i++ . "
                        </td>
                        <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['police_station'] . " 
                        </td>
                        <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['court_name'] . " 
                        </td>
                        <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['crime_number'] . " 
                        </td>
                        <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                        " . $row['penal_code'] . " 
                        </td>
                        <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                        " . $row['result_date'] . " 
                        </td>
                        <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['culprit_name'] . " " . $row['culprit_address'] . " 
                        </td>
                        <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . (new DateTime($row['updated_at']))->format('Y-m-d') . " 
                        </td>
                        <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                            " . $row['judgement_of_court'] . " 
                        </td>
                    </tr>";
    }
    if (!($found_judgements)) {
        $html .= "<tr>
            <td colspan=9 style=' height:50px; font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                निरंक
            </td>
        </tr>
        ";
    }
    $html .= "<tr><td colspan=9></td></tr>";

    $html .= "</table>";

    $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:x="urn:schemas-microsoft-com:office:excel"
    xmlns="http://www.w3.org/TR/REC-html40">'
        . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
        . '<body>' . $html . '</body></html>';


    return $html;
    // header('Content-Type: application/xls');
    // header('Content-Disposition: attachment; filename=court_judgements' . $date . '.xls');
    // echo $html;
}

function generateImportantAchievementsExcel($date, $district)
{
    $html = "<table style='vertical-align:middle;'>
                <tr>
                    <th colspan=8 center style='font-size: 42px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; height:75px;'>महत्पूर्ण कार्यवाहिया / उपलब्धियां | $date</th>
                </tr>
                <tr style='height:240px;'>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:45px;'>क्र.</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:150px;'>थाना/चौकी</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:500px;'>गंभीर अपराधों में गिरफ्तारि / महत्वपूर्ण गिरफ्तारि</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:170px;'>कोर्ट द्वारा दिए गये निर्णय (दोषमुक्त / सजा / जमानत /रद्द)</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:300px;'>आपरेशन मुस्कान / गुम इंसान दस्तायी</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:120px'>डकैती / लुट / चोरी का खुलासा</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:270px;'>विविध जैसे जन जागरुकता अभियान मे विशेष सफलता या प्राण रक्षा,गिरफ्तारी वारंटो की तमिलि आदि</th>
                    <th style='font-size: 26px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center; width:200px;'>धारा 102 के तहत कि गई कार्यवाही</th>
                </tr>";
    $i = 1;
    $found_achievements = false;
    foreach (get_important_achievements($date, $district) as $row) {
        $found_achievements = true;
        $html .= "<tr>
                <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                    " . $i++ . "
                </td>
                <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                    " . $row['police_station'] . " 
                </td>
                <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                    " . $row['arrest_in_major_crime'] . " 
                </td>
                <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                    " . $row['decision_given_by_the_court'] . " 
                </td>
                <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                " . $row['missing_man_document'] . " 
                </td>
                <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                    " . $row['robbery'] . " 
                </td>
                <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                    " . $row['miscellaneous'] . " 
                </td>
                <td style=' font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                    " . $row['action_taken_under'] . " 
                </td>
            </tr>";
    }
    if (!($found_achievements)) {
        $html .= "<tr>
                    <td colspan=8 style=' height:50px; font-size: 24px; border:1px solid black; border-collapse: collapse; vertical-align:middle; text-align:center;'>
                        निरंक
                    </td>
                </tr>
                ";
    }
    $html .= "<tr><td colspan=8></td></tr>";

    $html .= "</table>";

    $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:x="urn:schemas-microsoft-com:office:excel"
    xmlns="http://www.w3.org/TR/REC-html40">'
        . '<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head>'
        . '<body>' . $html . '</body></html>';
    return $html;


    // header('Content-Type: application/xls');
    // header('Content-Disposition: attachment; filename=important_achievements' . $date . '.xls');
    // echo $html;
}
