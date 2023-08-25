<?php

require_once '../pages/mvc/model/dbcon.mod.php';
require_once '../pages/mvc/controller/class-autoload.cont.php';
require_once '../pages/mvc/model/sched.mod.php';

$sched = new Schedule($_POST['contract']);



if(isset($_POST['startDate'])){

    $sched->setStartDate($_POST['startDate']);

    echo json_encode(array("table" => $sched->loadTable())); 

}else if(isset($_POST['status'])){

    $sched->setProcessStatus($_POST['status']);

    echo json_encode(array("msg" => 'Process loan sucessful.'));
}

//die(strval($sched->loadTable()));


?>