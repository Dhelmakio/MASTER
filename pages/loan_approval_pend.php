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
if(isset($_GET['con'])){
    $alog_id = $_SESSION['user_id'];
    $alog_name = $_SESSION['name'];
    $contract_no = $_GET['con'];
    $approve = "UPDATE loan_applications set approval=1, approval_date='$now', approved_by='$alog_name' where contract_no='$contract_no'";
    $stmt = $con->prepare($approve);
    if($stmt->execute()){
        
        $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','Pend loan application')";
        mysqli_query($con,$log);
        header('location: loan_approval.php?msg=success');
    }
}
?>
