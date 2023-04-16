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

    print_r($errors);

    if (empty($errors)) {
        if ($old_password == $user['password']) {
            if ($new_password == $confirm_new_password) {

                $query = "UPDATE users SET password = '$new_password' WHERE user_id = '$user_id'";
                $query_run = mysqli_query($con, $query);
                $_SESSION['message'] = "Password changed successfully.";
                $_SESSION['type'] = "success";

                // Update User Data
                if ($query_run) {
                    $query = "SELECT * FROM users WHERE `user_type` = 'admin' and `user_id` = '$user_id'";
                    $result = mysqli_query($con, $query);
                    $_SESSION['user-data'] = mysqli_fetch_array($result);
                }

            } else {
                $_SESSION['message'] = "Password do not match.";
                $_SESSION['type'] = "danger";

            }
        } else {
            $_SESSION['message'] = "Does not match with your old password.";
            $_SESSION['type'] = "danger";
        }
        header("Location: ../admin/change_password.php");
    } else {
        $_SESSION['message'] = $errors[0];
        $_SESSION['type'] = "warning";
        header("Location: ../user/change_password.php");
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
        if ($old_password == $user['password']) {
            if ($new_password == $confirm_new_password) {

                $query = "UPDATE users SET password = '$new_password' WHERE user_id = '$user_id'";
                $query_run = mysqli_query($con, $query);
                $_SESSION['message'] = "Password changed successfully.";
                $_SESSION['type'] = "success";

                // Update User Data
                if ($query_run) {
                    $query = "SELECT * FROM users WHERE `user_type` = 'user' and `user_id` = '$user_id'";
                    $result = mysqli_query($con, $query);
                    $_SESSION['user-data'] = mysqli_fetch_array($result);
                }

            } else {
                $_SESSION['message'] = "Password do not match.";
                $_SESSION['type'] = "danger";

            }
        } else {
            $_SESSION['message'] = "Does not match with your old password.";
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