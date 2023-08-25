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

if(isset($_POST['submit_collection'])){
    $id = $_POST['id'];
    $collection = $_POST['collection'];

    $sql = "UPDATE collection SET collection_percentage = '$collection' WHERE collection_id = '$id'";
    $result = mysqli_query($con, $sql);

    if($result){
        header("location:../pages/setting_collection.php");
    }
}

if(isset($_POST['submit_processing'])){
    $id = $_POST['id'];
    $processing = $_POST['processing'];

    $sql = "UPDATE processing SET processing_percentage = '$processing' WHERE processing_id = '$id'";
    $result = mysqli_query($con, $sql);

    if($result){
        header("location:../pages/setting_processing.php");
    }
}
?>