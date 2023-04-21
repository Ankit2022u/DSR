<?php
require '../api/dbcon.php';
session_start();
$user = $_SESSION['user-data'];
$uid = $user['uid'];
$name = $user['user_id'];
$log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1,'$name','No table','$uid','logout', '$name logged out of the system.')";
$log_query_run = mysqli_query($con, $log_query);
session_destroy();
header('Location: ../index.php');
?>