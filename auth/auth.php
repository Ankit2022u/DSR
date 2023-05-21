<?php

require '../api/dbcon.php';
session_start();

if (isset($_POST['login'])) {

    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $password = $_POST['password']; // Password not escaped as it's hashed before querying

    $query = "SELECT * FROM users WHERE `user_type` = ? AND `user_id` = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ss", $user_type, $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_array($result);
        if ($user['status']) {
            if (password_verify($password, $user['password'])) { // Verify hashed password
                $_SESSION['user-data'] = $user;

                $uid = $user['uid'];
                $userid = $user['user_id'];
                $user_name = $_SESSION['user-data']['officer_name'];
                $log_query = "INSERT INTO `logs`( `status`, `created_by`, `table_name`, `table_id`, `operation`,`log_desc`) VALUES (1,?,?,?,?,?)";
                $log_stmt = mysqli_prepare($con, $log_query);
                $log_desc = $user_name . " logged in the system.";
                $table_name = 'No table';
                $operation = 'login';
                mysqli_stmt_bind_param($log_stmt, "sssss", $userid, $table_name, $uid, $operation, $log_desc);
                mysqli_stmt_execute($log_stmt);

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
            $_SESSION['message'] = "USER ID IS NOT ACTIVE.";
            $_SESSION['type'] = "info";
            $_SESSION['login_type'] = $user_type;
            header("Location: ../login.php");
        }
    } else {
        $query = "SELECT * FROM users WHERE `user_id` = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
