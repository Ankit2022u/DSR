<?php 

require '../api/dbcon.php';
session_start();

if(isset($_POST['login'])){

    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM users WHERE `user_type` = '$user_type' and `user_id` = '$user_id' and `password` = '$password'";
    $result = mysqli_query($con, $query);

    if( mysqli_num_rows($result) > 0){
        $_SESSION['user-data'] = mysqli_fetch_array($result);

        if($user_type == "admin"){
            header("Location: ../admin/admin.php");
        }
        else{
            header("Location: ../user/user.php");
        }
    }
}

?>
