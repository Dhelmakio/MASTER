<?php
session_start();
include('../config/conn.php');
// $id;
$dob = $_POST['dob'];
    // $dob = date('Y-m-d',strtotime($_POST['dob']));
$dob2 = date('Y-m-d',strtotime($dob));
echo $dob;
echo $dob2;



?>
