<?php

require '../api/dbcon.php';
session_start();

if (isset($_POST['login'])) {

    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM users WHERE `user_type` = '$user_type' and `user_id` = '$user_id' and `password` = '$password'";
    $result = mysqli_query($con, $query);
    // echo $query;

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_array($result);
        if ($user['status']) {
            $_SESSION['user-data'] = $user;

            $uid = $user['uid'];
            $userid = $user['user_id'];
            $user_name = $_SESSION['user-data']['officer_name'];
            $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1,'$userid','No table','$uid','login', '$user_name logged in the system.')";
            $log_query_run = mysqli_query($con, $log_query);

            if ($user_type == "admin") {
                header("Location: ../admin/admin.php");
            } else {
                header("Location: ../user/user.php");
            }
        } else {
            $_SESSION['message'] = "USER ID IS NOT ACTIVE.";
            $_SESSION['type'] = "info";
            $_SESSION['login_type'] = $user_type;
            header("Location: ../login.php");
        }

    } else {
        $query = "SELECT * FROM users WHERE `user_id` = '$user_id' and `password` = '$password'";
        $query_run = mysqli_query($con, $query);
        $result = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

        if (count($result) > 0) {
            $_SESSION['message'] = "UNAUTHORIZED ACCESS. TRY LOGIN IN WITH CORRECT DETAILS !!!";
            $_SESSION['type'] = "danger";
        } else {
            $_SESSION['message'] = "WRONG USER_ID OR PASSWORD. TRY LOGIN IN WITH CORRECT DETAILS !!!";
            $_SESSION['type'] = "warning";
        }
        $_SESSION['login_type'] = $user_type;
        header("Location: ../login.php");

    }
}

?>