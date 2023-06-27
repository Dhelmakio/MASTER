<?php
include('../config/conn.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "delete from clients where client_id='$id'";
    if(mysqli_query($con,$sql)){
        $sql2 = "delete from client_info where client_id='$id'";
        if(mysqli_query($con,$sql2)){
            $sql3 = "delete from dependents where client_id='$id'";
            if(mysqli_query($con,$sql3)){
                $sql4 = "delete from employer where client_id='$id'";
                if(mysqli_query($con,$sql4)){
                    $sql5 = "delete from char_references where client_id='$id'";
                    if(mysqli_query($con,$sql5)){
                    header("location: reg_applicant.php?success");
                    }
                }
            }
        }   
    }else{
        header("location: reg_applicant.php?failed");
    }
}

