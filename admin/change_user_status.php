<?php

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
        // if(!empty($profile_photo_path) && file_exists('../uploads/'.$user_type."/".$profile_photo_path)){
        //     unlink('../uploads/'.$user_type."/".$profile_photo_path);
        // }
        $_SESSION['message'] = "User "."$msg"." successfully";
        $_SESSION['type'] = "success";
        header("Location: manage_user.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Not "."$msg"." successfully.";
        $_SESSION['type'] = "danger";
        header("Location: maange_user.php");
        exit(0);
    }


}
?>