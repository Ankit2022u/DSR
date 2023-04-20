<?php
// Fetch items based on selected district
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the selected district from POST data
    $district = $_POST["district"];

    // Connect to your database
    require 'dbcon.php';
    require 'functions.php';

    $items = get_police_station($district);

    // Return items as JSON response
    header("Content-Type: application/json"); // Add this line to set the Content-Type header
    echo json_encode($items);
} else {
    // Return error if accessed directly
    echo json_encode(array("error" => "Invalid request")); // Modify to return valid JSON error message
}
?>




