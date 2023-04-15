<?php
session_start();

if (!(isset($_SESSION['user-data']))) {
  header("Location: ../index.php");
}
else{
    unset($_SESSION['user-data']);
    header("Location: ../index.php");
}


?>