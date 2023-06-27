<?php
require_once('../config/conn.php');

function log_task($id,$task,$action){
    $sql = "INSERT INTO activity_log (emp_id,task_id,action) VALUES ('$id','$task','$action')";
    mysqli_query($con, $sql);
        $con->query($sql);
}

function log_action($id,$action){
    $sql = "INSERT INTO activity_log (emp_id,action) VALUES ('$id','$action')";
    mysqli_query($con, $sql);
        $con->query($sql);
}



?>