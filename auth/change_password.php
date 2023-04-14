<?php
session_start();
require '../api/dbcon.php';
$user = $_SESSION['user-data'];

if (isset($_POST['change_password_admin'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $old_password = mysqli_real_escape_string($con, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_new_password = mysqli_real_escape_string($con, $_POST['confirm_new_password']);

    if ($old_password == $user['password']) {
        if ($new_password == $confirm_new_password) {

            $query = "UPDATE users SET password = '$new_password' WHERE user_id = '$user_id'";
            $query_run = mysqli_query($con, $query);
            $_SESSION['success'] = "Password changed successfully.";

            // Update User Data
            if ($query_run) {
                $query = "SELECT * FROM users WHERE `user_type` = 'admin' and `user_id` = '$user_id'";
                $result = mysqli_query($con, $query);
                $_SESSION['user-data'] = mysqli_fetch_array($result);
            }
            
        } else {
            $_SESSION['error'] = "Password do not match.";
            
        }
    } else {
        $_SESSION['error'] = "Does not match with your old password.";
    }

    header("Location: ../admin/change_password.php");
}

?>