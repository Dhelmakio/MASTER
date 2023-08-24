<?php
include('../config/conn.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
$now = date('Y-m-d G:i:s');
// if(isset($_GET['id'])){
//     $alog_id = $_SESSION['user_id'];
//     $alog_name = $_SESSION['name'];
//     $id = $_GET['id'];
//     $sql = "UPDATE loan_applications set ci_status=2, date_flagged='$now' where loan_id='$id'";
//     mysqli_query($con,$sql);
//     $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','Reject CI')";
//     mysqli_query($con,$log);
//     header('location:loan_credit_investigation.php?msg=failed');
// }

if(isset($_POST['submit_fail_remarks'])){
    $remarks = $_POST['remarks'];
    $contract = $_POST['contract'];
    $alog_id = $_SESSION['user_id'];
    $alog_name = $_SESSION['name'];
    $query = "UPDATE loan_applications SET ci_remarks = '$remarks' WHERE contract_no = '$contract'";
    $result = mysqli_query($con, $query);
    if($result == TRUE){
        $id = $_GET['id'];
        $sql = "UPDATE loan_applications set ci_status=2, date_flagged='$now' where contract_no='$contract'";
        mysqli_query($con,$sql);
        $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','Reject CI')";
        mysqli_query($con,$log);
        header('location:loan_credit_investigation.php?msg=failed');
    }else{
        header('location:loan_credit_investigation.php?msg=failed');
    }
}
?>