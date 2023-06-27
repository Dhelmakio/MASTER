<?php
require_once('../config/conn.php');

class Login extends DatabaseConnection {

    function auth_login($username, $password){
        if($this->check_user($username) != false){
            $pass = $this->check_user($username);
            if(password_verify($password, $pass)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function check_user($username){
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($this->connect(), $sql);
        if($result->num_rows > 0){
            while($row = mysqli_fetch_array($result)){
                return $row['password'];
            }
        }
        return false;
    }
    function setSession($username, $column){
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($this->connect(), $sql);
        if($result->num_rows > 0){
            while($row = mysqli_fetch_array($result)){
                return $_SESSION[$column] = $row[$column];
            }
        }
    }
}

?>