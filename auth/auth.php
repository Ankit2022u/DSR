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
        if($user['status']){
            $_SESSION['user-data'] = $user;
            if ($user_type == "admin") {
                header("Location: ../admin/admin.php");
            } else {
                header("Location: ../user/user.php");
            }
        }
        else{
            $_SESSION['message'] = "USER ID IS NOT ACTIVE.";
            $_SESSION['type'] = "info";
            header("Location: ../login.php");
        }

    } else {
        $query = "SELECT * FROM users WHERE `user_id` = '$user_id' and `password` = '$password'";
        $query_run = mysqli_query($con, $query);
        $result = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

        if (count($result) > 0) {
            $_SESSION['message'] = "UNAUTHORIZED ACCESS. TRY LOGIN IN WITH CORRECT DETAILS !!!";
            $_SESSION['type'] = "danger";
            header("Location: ../login.php");
        } else {
            $_SESSION['message'] = "WRONG USER_ID OR PASSWORD. TRY LOGIN IN WITH CORRECT DETAILS !!!";
            $_SESSION['type'] = "warning";
            header("Location: ../login.php");
        }
        

    }
}

?>