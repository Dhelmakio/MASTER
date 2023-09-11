<?php
session_start();
require_once '../pages/mvc/model/dbcon.mod.php';
require_once '../pages/mvc/controller/class-autoload.cont.php';
require_once '../pages/mvc/model/sched.mod.php';

$sched = new Schedule($_POST['contract']);

$now = date('Y-m-d G:i:s');
$alog_name = $_SESSION['name'];

if(isset($_POST['startDate'])){

    $sched->setStartDate($_POST['startDate']);

    $key = 'table'; $value = $sched->loadTable();

}else if(isset($_POST['status'])){

    $sched->setProcessStatus($_POST['status'], $alog_name, $now);

    $key = 'msg'; $value = 'Process loan sucessful.';
   
}else if(isset($_POST['update'])){

    $sched->updateLoanDetails($_POST['loan_terms'],$_POST['promissory_note'],$_POST['cash_out'],$_POST['amort_amount'], $_POST['udi_percentage'], $_POST['udi_value'], $_POST['process_status']);

    $key = 'msg'; $value = 'Loan details updated.';
   
}

//die(strval($sched->loadTable()));

echo json_encode(array($key => $value));




?>