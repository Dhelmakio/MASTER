<?php
require_once('../config/conn.php');


if(isset($_REQUEST['access'])){
    if ($stmt = $con->prepare('SELECT user_id, password, name FROM users WHERE access_level = ?')) {
        $access = 1;
        $stmt->bind_param('i', $access);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password, $name);
            $stmt->fetch();
            if (password_verify($_REQUEST['access'], $password)) {
                $key = 'access'; $value = 'Access Granted!';
            }else{
                $key = 'noAccess'; $value = 'Access Denied!';
            }
        }
    }
}

echo json_encode(array($key => $value));

?>