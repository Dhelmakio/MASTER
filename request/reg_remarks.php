<?php

include '../config/conn.php';
session_start();

$alog_id;
$alog_name;

if(isset($_POST['approve'])){
    $contract = $_POST['id'];
    $remark = "approved";
    $sql = "UPDATE loan_applications SET remarks = '$remark' WHERE contract_no = '$contract'";
    $result = mysqli_query($con, $sql);

    if($result){
        //header("location:../pages/loan_approval_preview.php?con=$contract");
       
        if(!isset($_SESSION['user_id'])){
            $alog_id = $_SESSION['user_id'];
            $alog_name = $_SESSION['name'];
            header('location:login.php');
        }

        $now = date('Y-m-d G:i:s');
        if(isset($_POST['id'])){

            $alog_id = $_SESSION['user_id'];
            $alog_name = $_SESSION['name'];
            $contract_no = $_POST['id'];
            $approve = "UPDATE loan_applications set approval=1, date_flagged='$now', processed_by='$alog_name' where contract_no='$contract_no'";
            $stmt = $con->prepare($approve);
            if($stmt->execute()){
                $msg = "Approved loan application: ".$contract_no;
                $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','$msg')";
                mysqli_query($con,$log);
                header('location: ../pages/loan_approval.php?msg=success');
            }
        }
    }
}else if(isset($_POST['decline'])){
    $contract = $_POST['id'];
    $remark = "decline";
    $sql = "UPDATE loan_applications SET remarks = '$remark' WHERE contract_no = '$contract'";
    $result = mysqli_query($con, $sql);

    if($result){
        //header("location:../pages/loan_approval.php");
        if(!isset($_SESSION['user_id'])){
            $alog_id = $_SESSION['user_id'];
            $alog_name = $_SESSION['name'];
            header('location:login.php');
        }
        
        $now = date('Y-m-d G:i:s');
        if(isset($_POST['id'])){
            
            $alog_id = $_SESSION['user_id'];
            $alog_name = $_SESSION['name'];
            $contract_no = $_POST['id'];
            $approve = "UPDATE loan_applications set approval=2, date_flagged='$now', processed_by='$alog_name' where contract_no='$contract_no'";
            $stmt = $con->prepare($approve);
            if($stmt->execute()){
                $msg = "Rejected loan application: ".$contract_no;
                $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','$msg')";
                mysqli_query($con,$log);
                header('location: ../pages/loan_approval.php?msg=success');
            }
        }
    }
}else if(isset($_POST['hold'])){
    $contract = $_POST['id'];
    $remark = "hold";
    $sql = "UPDATE loan_applications SET remarks = '$remark' WHERE contract_no = '$contract'";
    $result = mysqli_query($con, $sql);

    if($result){
        //header("location:../pages/loan_approval.php");
        if(!isset($_SESSION['user_id'])){
            $alog_id = $_SESSION['user_id'];
            $alog_name = $_SESSION['name'];
            header('location:login.php');
        }
        
        $now = date('Y-m-d G:i:s');
        if(isset($_POST['id'])){
          
            $alog_id = $_SESSION['user_id'];
            $alog_name = $_SESSION['name'];
            $contract_no = $_POST['id'];
            $hold = "UPDATE loan_applications set approval=3, date_flagged='$now', processed_by='$alog_name' where contract_no='$contract_no'";
            $stmt = $con->prepare($hold);
            if($stmt->execute()){
                $msg = "Holded loan application: ".$contract_no;
                $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','$msg')";
                mysqli_query($con,$log);
                header('location: ../pages/loan_approval.php?msg=success');
            }
        }
    }
}
?>