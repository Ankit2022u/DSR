<?php
session_start();
require '../api/dbcon.php';

if (isset($_POST['change_status'])) {
    $uid = mysqli_real_escape_string($con, $_POST['change_status']); // Sanitize user input

    // Get the profile photo path from the database
    $query = "SELECT status FROM users WHERE uid=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    $user_data = mysqli_fetch_assoc($query_run);
    $status = $user_data['status'];
    $msg = "Activated";
    $update_to = 1;

    if ($status) {
        $msg = "Deactivated";
        $update_to = 0;
    }

    $query = "UPDATE users SET status=? where uid=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "is", $update_to, $uid);
    $query_run = mysqli_stmt_execute($stmt);

    if ($query_run) {
        $user = $_SESSION['user-data']['user_id'];
        $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1, ?, 'users', ?, 'update', 'User Activated/Deactivated.')";
        $stmt = mysqli_prepare($con, $log_query);
        mysqli_stmt_bind_param($stmt, "si", $user, $uid);
        $log_query_run = mysqli_stmt_execute($stmt);

        $_SESSION['message'] = "User " . "$msg" . " successfully";
        $_SESSION['type'] = "success";
        header("Location: manage_user.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Not " . "$msg" . " successfully.";
        $_SESSION['type'] = "danger";
        header("Location: manage_user.php");
        exit(0);
    }
}
