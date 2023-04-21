<?php
session_start();
require '../api/dbcon.php';

if (isset($_POST['change_status'])) {
    $uid = mysqli_real_escape_string($con, $_POST['change_status']);

    // Get the profile photo path from the database
    $query = "SELECT status FROM users WHERE uid='$uid'";
    $query_run = mysqli_query($con, $query);
    $user_data = mysqli_fetch_assoc($query_run);
    $status = $user_data['status'];
    $msg = "Activated";
    $update_to = 1;

    if ($status) {
        $msg = "Deactivated";
        $update_to = 0;
    }
    $query = "UPDATE users SET status = '$update_to' where uid = '$uid'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $user = $_SESSION['user-data']['user_id'];
        $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1,'$user','users','$uid','update', 'User Activated/Deactivated.')";
        $log_query_run = mysqli_query($con, $log_query);
        // if(!empty($profile_photo_path) && file_exists('../uploads/'.$user_type."/".$profile_photo_path)){
        //     unlink('../uploads/'.$user_type."/".$profile_photo_path);
        // }
        $_SESSION['message'] = "User " . "$msg" . " successfully";
        $_SESSION['type'] = "success";
        header("Location: manage_user.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Not " . "$msg" . " successfully.";
        $_SESSION['type'] = "danger";
        header("Location: maange_user.php");
        exit(0);
    }


}
?>