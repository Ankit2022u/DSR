<?php 

require '../api/dbcon.php';

    if(isset($_POST['delete_user'])){
    $uid = mysqli_real_escape_string($con, $_POST['delete_user']);

    $query = "DELETE from users where uid='$uid'";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "User deleted successfully";
        header("Location: manage_user.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "User deletion failed due to some error.";
        header("Location: maange_user.php");
        exit(0);
    }

}
?>