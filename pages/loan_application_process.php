<?php
include('../config/conn.php');
$alog_id;
$alog_name;
session_start();
if(!isset($_SESSION['user_id'])){
    $alog_id = $_SESSION['user_id'];
    $alog_name = $_SESSION['name'];
    header('location:login.php');
}

if(isset($_POST['client_id'])){
    // $now = date("Y/m/d");
    $mop = $_POST['mop'];
    $cid = $_POST['client_id'];
    $mamort = $_POST['amortization'];
    $lamt = $_POST['lamt_'];
    $duration = $_POST['months_'];
    $ltype = $_POST['ltype'];
    $int_amt = $_POST['interest'];
    $fee = $_POST['notarial'];
    $cashout = $_POST['cashout'];

    // $cno = 'AMG'.date('Ymhms').$cid.date('d');
    $cno = $cid.date('Ymhms').date('d');
    $sql = "INSERT INTO loan_applications (contract_no,client_id,loan_type,loan_duration,loan_amount,interest_amount,other_fee,total_cashout,monthly_amortization,mop)
     VALUES ('$cno','$cid','$ltype','$duration','$lamt','$int_amt','$fee','$cashout','$mamort','$mop')";
    if(mysqli_query($con, $sql)){
        echo "<script>alert('Success.');</script>";
        $alog_id = $_SESSION['user_id'];
        $alog_name = $_SESSION['name'];
        $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','Added loan application')";
        mysqli_query($con,$log);
        header('location:loan_success.php');
    }else{
        echo "<script>alert('Failed.');</script>";
        header('location:loan_application.php?msg=failed');
    }
}else{

}

?>
