<?php

include '../config/conn.php';


if(isset($_POST['approve'])){
    $contract = $_POST['id'];
    $remark = "approved";
    $sql = "UPDATE loan_applications SET remarks = '$remark' WHERE contract_no = '$contract'";
    $result = mysqli_query($con, $sql);

    if($result){
        header("location:../pages/loan_approval_preview.php?con=$contract");
    }
}else if(isset($_POST['decline'])){
    $contract = $_POST['id'];
    $remark = "decline";
    $sql = "UPDATE loan_applications SET remarks = '$remark' WHERE contract_no = '$contract'";
    $result = mysqli_query($con, $sql);

    if($result){
        header("location:../pages/loan_approval.php");
    }
}else if(isset($_POST['hold'])){
    $contract = $_POST['id'];
    $remark = "hold";
    $sql = "UPDATE loan_applications SET remarks = '$remark' WHERE contract_no = '$contract'";
    $result = mysqli_query($con, $sql);

    if($result){
        header("location:../pages/loan_approval.php");
    }
}
?>