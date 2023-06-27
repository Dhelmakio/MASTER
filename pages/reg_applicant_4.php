<?php
session_start();
include('../config/conn.php');
$id;
if(isset($_SESSION['user_id'])){
    $id = $_SESSION['id'];
}else{
    // header('location: main_client.php');
}

if(isset($_POST['submit'])){
    
    if(isset($_POST['char_name'])){
        $wdep = true;
        $char_name = $_POST["char_name"];
        $char_contact = $_POST["char_contact"];
        $char_rel = $_POST["char_rel"];
        $char_time = $_POST["char_time"];
    

        if($wdep == true){
            $countarr = count($char_name);
            $count = 0;
            foreach($char_name as $cname){
                $insert_dep = "INSERT INTO char_references (client_id,name,contact,relationship,availability) values('$id','$char_name[$count]','$char_contact[$count]','$char_rel[$count]','$char_time[$count]')";
                echo $id.' '.$dep_name[$count].' '.$dep_dob[$count];
                mysqli_query($con,$insert_dep);
                $count++;
            }
        }

        $alog_id = $_SESSION['user_id'];
        $alog_name = $_SESSION['name'];
        $act = "Added character references: ".$id;
        $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','$act')";
        mysqli_query($con,$log);
        header('location: reg_applicant_file.php?id='.$id);
        // echo "New record created successfully. Last inserted ID is: " . $last_id;
    }else{
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}else{
    header('location: reg_failed.php');
}

?>
