<?php
require_once('../config/conn.php');

class Generate extends DatabaseConnection {
    
    public function generateId($abbrv, $branch, $table, $id){
        if(intval($this->checkRowCount($table)) == 0)
            $count = str_pad(1, 7, '0', STR_PAD_LEFT);
        else
            $count = str_pad(intval(substr($this->getLastRow($table, $id), -7))+1, 7, '0', STR_PAD_LEFT);
        
        return "{$abbrv}{$branch}{$count}";
    }

    public function getLastRow($table, $id){
        $sql = "SELECT * FROM $table ORDER BY $id DESC LIMIT 1";
        $result = mysqli_query($this->connect(), $sql);
        $result = mysqli_fetch_assoc($result);
        return $result[$id]??null;
    }

    public function checkRowCount($table){
        $sql = "SELECT count(*) FROM $table";
        $result = mysqli_query($this->connect(), $sql);
        $row = mysqli_fetch_array($result);
        return $row['count(*)'];
    }
}

?>