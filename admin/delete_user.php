<?php 

require '../api/dbcon.php';

    if(isset($_POST['delete_user'])){
    $uid = mysqli_real_escape_string($con, $_POST['delete_user']);

    // Get the profile photo path from the database
    $query = "SELECT profile_photo_path FROM users WHERE uid='$uid'";
    $query_run = mysqli_query($con, $query);
    $user_data = mysqli_fetch_assoc($query_run);
    $profile_photo_path = $user_data['profile_photo_path'];
    $user_type = $user_data['user_type'];

    $query = "DELETE from users where uid='$uid'";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        if(!empty($profile_photo_path) && file_exists('../uploads/'.$user_type."/".$profile_photo_path)){
            unlink('../uploads/'.$user_type."/".$profile_photo_path);
        }
        $_SESSION['message'] = "User deleted successfully";
        $_SESSION['type'] = "success";
        header("Location: manage_user.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "User deletion failed due to some error.";
        $_SESSION['type'] = "danger";
        header("Location: maange_user.php");
        exit(0);
    }

}
?>