<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "newdsr";

$con = mysqli_connect($hostname, $username, $password, $dbname);

if(!$con){
    die('Connection Failed'.mysqli_connect_error());
}

?>