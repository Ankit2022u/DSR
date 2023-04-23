<?php
require '../api/dbcon.php';
session_start();
$user = $_SESSION['user-data'];

// Use prepared statement to prevent SQL injection
$log_query = "INSERT INTO `logs`(`status`, `created_by`, `table_name`, `table_id`, `operation`, `log_desc`) VALUES (1,?,?,?,?,?)";
$stmt = mysqli_prepare($con, $log_query);
mysqli_stmt_bind_param($stmt, "sssss", $created_by, $table_name, $table_id, $operation, $log_desc);
$status = 1;
$created_by = $user['user_id'];
$name = $user['officer_name'];
$table_name = 'No table';
$table_id = $user['uid'];
$operation = 'logout';
$log_desc = $name . ' logged out of the system.';
$log_query_run = mysqli_stmt_execute($stmt);

session_destroy();

// Redirect to index.php to prevent further execution of code after session destruction
header('Location: ../index.php');
exit();

?>