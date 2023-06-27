<?php
session_start();
include('../config/conn.php');
$id;
$name;
if(isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
    $name = $_SESSION['name'];
    $log = "INSERT into activity_logs (user_id,name,activity) values ('$id','$name','Logged out')";
    mysqli_query($con,$log);
}



session_destroy();
header("location:login.php");
?>