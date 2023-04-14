<?php 

require 'dbcon.php';

function count_dead_bodies() {
    global $con;
    $query = "SELECT COUNT(*) from dead_bodies";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        // Query Failed
        echo "Error: " . mysqli_error($con);
        return 0;
    }

    // Query Success
    $result = mysqli_fetch_array($query_run);
    return $result[0];
}

function police_stations() {
    global $con;
    $query = "SELECT DISTINCT police_station from police_stations";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        // Query Failed
        echo "Error: " . mysqli_error($con);
        return 0;
    }

    // Query Success
    $result = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
    return $result;
}	

function count_major_crimes() {
    global $con;
    $query = "SELECT COUNT(*) from major_crimes";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        // Query Failed
        echo "Error: " . mysqli_error($con);
        return 0;
    }

    // Query Success
    $result = mysqli_fetch_array($query_run);
    return $result[0];
}
	
function count_minor_crimes() {	
    global $con;
    $query = "SELECT COUNT(*) from minor_crimes";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        // Query Failed
        echo "Error: " . mysqli_error($con);
        return 0;
    }

    // Query Success
    $result = mysqli_fetch_array($query_run);
    return $result[0];	

}	
function count_ongoing_cases() {
    global $con;
    $query = "SELECT COUNT(*) from ongoing_cases";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        // Query Failed
        echo "Error: " . mysqli_error($con);
        return 0;
    }

    // Query Success
    $result = mysqli_fetch_array($query_run);
    return $result[0];		

}	
function count_police_stations() {
    global $con;
    $query = "SELECT COUNT(*) from police_stations";
    $query_run = mysqli_query($con, $query);
    
    if (!$query_run) {
        // Query Failed
        echo "Error: " . mysqli_error($con);
        return 0;
    }

    // Query Success
    $result = mysqli_fetch_array($query_run);
    return $result[0];		

}	
function count_users() {
    global $con;
    $query = "SELECT COUNT(*) from users";
    $query_run = mysqli_query($con, $query);
    
    if (!$query_run) {
        // Query Failed
        echo "Error: " . mysqli_error($con);
        return 0;
    }

    // Query Success
    $result = mysqli_fetch_array($query_run);
    return $result[0];		

}	

?>
