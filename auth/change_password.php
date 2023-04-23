<?php
session_start();
require '../api/dbcon.php';
$user = $_SESSION['user-data'];

if (isset($_POST['change_password_admin'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $old_password = mysqli_real_escape_string($con, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_new_password = mysqli_real_escape_string($con, $_POST['confirm_new_password']);

    $errors = array();

    // Minimum password length of 8 characters
    if (strlen($new_password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Maximum password length of 20 characters
    if (strlen($new_password) > 20) {
        $errors[] = "Password cannot be longer than 20 characters.";
    }

    // Password must contain at least one uppercase letter
    if (!preg_match('/[A-Z]/', $new_password)) {
        $errors[] = "Password must contain at least one uppercase letter.";
    }

    // Password must contain at least one lowercase letter
    if (!preg_match('/[a-z]/', $new_password)) {
        $errors[] = "Password must contain at least one lowercase letter.";
    }

    // Password must contain at least one number
    if (!preg_match('/[0-9]/', $new_password)) {
        $errors[] = "Password must contain at least one number.";
    }

    // Password must contain at least one special character
    if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $new_password)) {
        $errors[] = "Password must contain at least one special character.";
    }

    // print_r($errors);

    if (empty($errors)) {
        if (password_verify($old_password, $user['password'])) {
            if ($new_password == $confirm_new_password) {
                // Update user password using prepared statement
                $query = "UPDATE users SET password = ? WHERE user_id = ?";
                $stmt = mysqli_prepare($con, $query);
                $passx = password_hash($new_password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "si", $passx, $user_id);
                $query_run = mysqli_stmt_execute($stmt);

                // Update user log
                if ($query_run) {
                    $user_id = $_SESSION['user-data']['user_id'];
                    $uid = $_SESSION['user-data']['uid'];
                    $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`, `log_desc`) VALUES (1,?,?,?,?,?)";
                    $stmt = mysqli_prepare($con, $log_query);
                    $log_desc = "User Password Changed.";
                    $userx = 'users';
                    $operation = 'update';
                    mysqli_stmt_bind_param($stmt, "isssss", $user_id, $userx, $uid, $operation, $log_desc);
                    mysqli_stmt_execute($stmt);

                    $_SESSION['message'] = "Password changed successfully.";
                    $_SESSION['type'] = "success";

                    // Fetch updated user data
                    $query = "SELECT * FROM users WHERE `user_type` = 'admin' and `user_id` = ?";
                    $stmt = mysqli_prepare($con, $query);
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $_SESSION['user-data'] = mysqli_fetch_array($result);
                } else {
                    $_SESSION['message'] = "Failed to update password.";
                    $_SESSION['type'] = "danger";
                }
            } else {
                $_SESSION['message'] = "Passwords do not match.";
                $_SESSION['type'] = "danger";
            }
        } else {
            $_SESSION['message'] = "Incorrect old password.";
            $_SESSION['type'] = "danger";
        }
        header("Location: ../admin/change_password.php");
    } else {
        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";
        header("Location: ../admin/change_password.php");
    }

}

if (isset($_POST['change_password_user'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $old_password = mysqli_real_escape_string($con, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_new_password = mysqli_real_escape_string($con, $_POST['confirm_new_password']);

    $errors = array();

    // Minimum password length of 8 characters
    if (strlen($new_password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Maximum password length of 20 characters
    if (strlen($new_password) > 20) {
        $errors[] = "Password cannot be longer than 20 characters.";
    }

    // Password must contain at least one uppercase letter
    if (!preg_match('/[A-Z]/', $new_password)) {
        $errors[] = "Password must contain at least one uppercase letter.";
    }

    // Password must contain at least one lowercase letter
    if (!preg_match('/[a-z]/', $new_password)) {
        $errors[] = "Password must contain at least one lowercase letter.";
    }

    // Password must contain at least one number
    if (!preg_match('/[0-9]/', $new_password)) {
        $errors[] = "Password must contain at least one number.";
    }

    // Password must contain at least one special character
    if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $new_password)) {
        $errors[] = "Password must contain at least one special character.";
    }

    if (empty($errors)) {
        if (password_verify($old_password, $user['password'])) {
            if ($new_password == $confirm_new_password) {

                // Use prepared statement to prevent SQL injection
                $query = "UPDATE users SET password = ? WHERE user_id = ?";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "si", $new_password, $user_id);
                $query_run = mysqli_stmt_execute($stmt);

                if ($query_run) {
                    $_SESSION['message'] = "Password changed successfully.";
                    $_SESSION['type'] = "success";

                    // Update User Data
                    $query = "SELECT * FROM users WHERE `user_type` = 'user' and `user_id` = ?";
                    $stmt = mysqli_prepare($con, $query);
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $_SESSION['user-data'] = mysqli_fetch_array($result);

                } else {
                    $_SESSION['message'] = "Failed to update password.";
                    $_SESSION['type'] = "danger";
                }

            } else {
                $_SESSION['message'] = "Passwords do not match.";
                $_SESSION['type'] = "danger";
            }
        } else {
            $_SESSION['message'] = "Old password does not match.";
            $_SESSION['type'] = "danger";
        }
        header("Location: ../user/change_password.php");
    } else {
        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";
        header("Location: ../user/change_password.php");
    }


}

?>