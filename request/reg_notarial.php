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
?>