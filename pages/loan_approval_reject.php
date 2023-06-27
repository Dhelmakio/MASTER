<?php
include('../config/conn.php');
session_start();
$alog_id;
$alog_name;
if(!isset($_SESSION['user_id'])){
    $alog_id = $_SESSION['user_id'];
    $alog_name = $_SESSION['name'];
    header('location:login.php');
}

$now = date('Y-m-d G:i:s');
if(isset($_POST['con'])){
    $alog_id = $_SESSION['user_id'];
    $alog_name = $_SESSION['name'];
    $contract_no = $_POST['con'];
    $reason = $_POST['reason'];
    $approve = "UPDATE loan_applications set approval=2, remarks='$reason', date_flagged='$now', processed_by='$alog_name' where contract_no='$contract_no'";
    $stmt = $con->prepare($approve);
    if($stmt->execute()){
        $msg = "Rejected loan application: ".$contract_no;
        $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','$msg')";
        mysqli_query($con,$log);
        header('location: loan_approval.php?msg=success');
    }
}
?>
