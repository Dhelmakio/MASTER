<?php
include '../config/conn.php';


if(isset($_POST['submit_notarial'])){
    
    $notarial = $_POST['notarial'];

    $sql = "UPDATE fees SET notarial_fee = '$notarial' WHERE notarial_id = 1 ";
    $result = mysqli_query($con, $sql);

    if($result){
        header("location:../pages/setting_notarial.php");
    }
}

if(isset($_POST['submit_sukli'])){
    $id = $_POST['id'];
    $sukli = $_POST['sukli'];

    $sql = "UPDATE sukli SET sukli_amount = '$sukli' WHERE sukli_id = '$id'";
    $result = mysqli_query($con, $sql);

    if($result){
        header("location:../pages/setting_sukli.php");
    }
}

if(isset($_POST['submit_base'])){
    $id = $_POST['id'];
    $base = $_POST['base'];

    $sql = "UPDATE borrowing_history SET base = '$base' WHERE bh_id = '$id'";
    $result = mysqli_query($con, $sql);

    if($result){
        header("location:../pages/setting_borrowing_history.php");
    }
}
?>