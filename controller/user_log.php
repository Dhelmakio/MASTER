<?php
require_once('../config/conn.php');
class User extends DatabaseConnection {

    function log_task($id,$task,$action){
        $sql = "INSERT INTO activity_logs (emp_id,task_id,action) VALUES ('$id','$task','$action')";
        $result = mysqli_query($this->connect(), $sql);    
    }
    
    function log_action($id,$action){
        $sql = "INSERT INTO activity_logs (emp_id,action) VALUES ('$id','$action')";
        $result = mysqli_query($this->connect(), $sql); 
    }
    
    function login($id, $name){
        $log = "INSERT into activity_logs (user_id,name,activity) values ('$id','$name','logged in')";
        $result = mysqli_query($this->connect(), $log);
    }

    function logout($id, $name){
        $log = "INSERT into activity_logs (user_id,name,activity) values ('$id','$name','Logged out')";
        $result = mysqli_query($this->connect(), $log);
    }
}
?>