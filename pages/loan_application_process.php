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
    if($mop == 1){
        $mamort = $_POST['amortization'];
    }else if($mop == 2){
        $mamort = $_POST['amortization2'];
    }else if($mop == 3){
        $mamort = $_POST['amortization3'];
    }
    
    // die($mamort);
    $lamt = $_POST['lamt_'];
    $duration = $_POST['months_'];
    $ltype = $_POST['ltype'];
    $int_amt = $_POST['interest']??null;
    $fee = $_POST['notarial'];
    $cashout = $_POST['cashout'];
    $ltypeTemp = 0;
    $ob = $_POST['outstanding_balance']??0;
    $udi_percentage = $_POST['monthly_interest']??0;
    $udi_value = $_POST['prevudi_']??0;
    $interest_percentage = $_POST['interest_percentage']??0;

    if($ltype == "NEW"){
        $ltypeTemp = 1;
    }else if($ltype == "RENEWAL"){
        $ltypeTemp = 2;
    }if($ltype == "RELOAN"){
        $ltypeTemp = 3;
    }if($ltype == "ADDITIONAL"){
        $ltypeTemp = 4;
    }

    $pay1 = "";
    $pay2 = "";
    $pay3 = "";
    $pay4 = "";

    if($mop == 1){
        $pay1 = $_POST['m1']??null;
    }else if($mop == 2){
        $pay1 = $_POST['sm1']??null;
        $pay2 = $_POST['sm2']??null;
    }else if($mop == 3){
        $pay1 = $_POST['w1']??null;
        $pay2 = $_POST['w2']??null;
        $pay3 = $_POST['w3']??null;
        $pay4 = $_POST['w4']??null;
    }

    $now = date('Y-m-d G:i:s');
    $alog_name = $_SESSION['name'];

    // $cno = 'AMG'.date('Ymhms').$cid.date('d');
    $cno = $cid.date('Ymhms').date('d');
    $sql = "INSERT INTO loan_applications (contract_no,client_id,loan_type,loan_duration,loan_amount,interest_amount,other_fee,total_cashout,monthly_amortization,mop,ob,udi_percentage,udi_value,interest_percentage,pay1,pay2,pay3,pay4,initiated_by, initiated_date)
     VALUES ('$cno','$cid','$ltypeTemp','$duration','$lamt','$int_amt','$fee','$cashout','$mamort','$mop', '$ob', '$udi_percentage', '$udi_value', '$interest_percentage', '$pay1', '$pay2', '$pay3', '$pay4', '$alog_name', '$now')";
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
