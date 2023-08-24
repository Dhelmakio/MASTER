<?php
include('../config/conn.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}

// if(isset($_GET['id'])){
//     $alog_id = $_SESSION['user_id'];
//     $alog_name = $_SESSION['name'];
//     $id = $_GET['id'];
//     $now = date('Y-m-d G:i:s');
//     $sql = "UPDATE loan_applications set ci_status=1, ci_date='$now', ci_by='$alog_name' where loan_id='$id'";
//     if(mysqli_query($con,$sql)){
//         $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','Approved CI')";
//         mysqli_query($con,$log);
//         header('location:loan_credit_investigation.php?msg=success');
//     }
// }

// else if(isset($_GET['contract'])){
//     $alog_id = $_SESSION['user_id'];
//     $alog_name = $_SESSION['name'];
//     $id = $_GET['contract'];
//     $now = date('Y-m-d G:i:s');
//     $sql = "UPDATE loan_applications set ci_status=1, ci_date='$now', ci_by='$alog_name' where contract_no='$id'";
//     if(mysqli_query($con,$sql)){
//         $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','Approved CI')";
//         mysqli_query($con,$log);
//         header('location:loan_credit_investigation.php?msg=success');
//     }
// }

if(isset($_POST['submit_pass_remarks'])){
    $remarks = $_POST['remarks'];
    $contract = $_POST['contract'];
    $alog_id = $_SESSION['user_id'];
    $alog_name = $_SESSION['name'];
    $now = date('Y-m-d G:i:s');
    $query = "UPDATE loan_applications SET ci_remarks = '$remarks' WHERE contract_no = '$contract'";
    $result = mysqli_query($con, $query);
    if($result == TRUE){
        $id = $_GET['id'];
        $sql = "UPDATE loan_applications set ci_status = 1, ci_date='$now', ci_by='$alog_name' where contract_no='$contract'";
        mysqli_query($con,$sql);
        $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','Approved CI')";
        mysqli_query($con,$log);
        header('location:loan_credit_investigation.php?msg=success');
    }
}
?>