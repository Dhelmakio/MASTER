<?php
session_start();
include('../config/conn.php');
$id;
if(isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
}else{
    // header('location: main_client.php');
}

// die(isset($_POST['submit_relative']));


$contract = $_POST['contract'];

if(isset($_POST['submit_relative'])){
    $q1=$_POST['q1'];
    $q2=$_POST['q2'];
    $q3=$_POST['q3'];
    $q4=$_POST['q4'];
    $q5=$_POST['q5'];
    $q6=$_POST['q6'];
    $q7=$_POST['q7'];
    $q8=$_POST['q8'];
    $q9=$_POST['q9'];
    $q10=$_POST['q10'];
    $q11=$_POST['q11'];
    $q12=$_POST['q12'];
    $q13=$_POST['q13'];
    $q14=$_POST['q14'];
    $q15=$_POST['q15'];
    $q16=$_POST['q16'];
    $q17=$_POST['q17'];
    $q18=$_POST['q18'];
    $q19=$_POST['q19'];
    $q20=$_POST['q20'];
    $q21=$_POST['q21'];
    $q22=$_POST['q22'];
    $q23=$_POST['q23'];
    $q24=$_POST['q24'];
    $q25=$_POST['q25'];
    $q26=$_POST['q26'];
    $q27=$_POST['q27'];
    $q28=$_POST['q28'];
    $q29=$_POST['q29'];
    $q30=$_POST['q30'];

    $sql = "INSERT INTO answers (contract_no, question1,	question2,	question3,	question4,	question5,	question6,	question7,	question8,	question9,	question10,	question11,	question12,	question13,	question14,	question15,	question16,	question17,	question18,	question19,	question20,	question21,	question22,	question23,	question24,	question25,	question26,	question27,	question28,	question29, question30) 
    VALUES('$contract','$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$q9','$q10','$q11','$q12','$q13','$q14','$q15','$q16','$q17','$q18','$q19','$q20','$q21','$q22','$q23','$q24','$q25','$q26','$q27','$q28','$q29','$q30')";

    if(mysqli_query($con, $sql)){
        $act = "Answered Relative Questionnaire: ".$contract;
        $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','$act')";
        mysqli_query($con,$log);
        header('location: loan_credit_investigation.php');
    }else{
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}else if(isset($_POST['submit_coworker'])){
    //  die("paras coworker");
    $q31=$_POST['q31'];
    $q32=$_POST['q32'];
    $q33=$_POST['q33'];
    $q34=$_POST['q34'];
    $q35=$_POST['q35'];
    $q36=$_POST['q36'];
    $q37=$_POST['q37'];
    $q38=$_POST['q38'];
    $q39=$_POST['q39'];
    $q40=$_POST['q40'];
    $q41=$_POST['q41'];
    $q42=$_POST['q42'];
    $q43=$_POST['q43'];
    $q44=$_POST['q44'];
    $q45=$_POST['q45'];
    $q46=$_POST['q46'];
    $q47=$_POST['q47'];
    $q48=$_POST['q48'];
    $q49=$_POST['q49'];
    $q50=$_POST['q50'];
    $q51=$_POST['q51'];
    $q52=$_POST['q52'];
    $q53=$_POST['q53'];
    $q54=$_POST['q54'];
    $q55=$_POST['q55'];
    $q56=$_POST['q56'];
    $q57=$_POST['q57'];
    $q58=$_POST['q58'];
    $q59=$_POST['q59'];
    $q60=$_POST['q60'];


    $alog_id = $_SESSION['user_id'];
    $alog_name = $_SESSION['name'];
    // $loan_type = $_POST['loan_type'];
    
    // $sql = "INSERT INTO answers (contract_no, question1,	question2,	question3,	question4,	question5,	question6,	question7,	question8,	question9,	question10,	question11,	question12,	question13,	question14,	question15,	question16,	question17,	question18,	question19,	question20,	question21,	question22,	question23,	question24,	question25,	question26,	question27,	question28,	question29,	question30,	question31,	question32,	question33,	question34,	question35,	question36,	question37,	question38,	question39,	question40,	question41,	question42,	question43,	question44,	question45,	question46,	question47,	question48,	question49,	question50,	question51,	question52,	question53,	question54,	question55,	question56,	question57,	question58,	question59,	question60,	question61,	question62) 
    // VALUES('$contract','$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$q9','$q10','$q11','$q12','$q13','$q14','$q15','$q16','$q17','$q18','$q19','$q20','$q21','$q22','$q23','$q24','$q25','$q26','$q27','$q28','$q29','$q30','$q31','$q32','$q33','$q34','$q35','$q36','$q37','$q38','$q39','$q40','$q41','$q42','$q43','$q44','$q45','$q46','$q47','$q48','$q49','$q50','$q51','$q52','$q53','$q54','$q55','$q56','$q57','$q58','$q59','$q60','$q61','$q62')";
    $sql = "UPDATE answers SET question31 = '$q31',	question32 = '$q32', question33 = '$q33', question34 = '$q34',	question35 = '$q35', question36= '$q36',	question37= '$q37',	question38= '$q38',	question39= '$q39',	question40= '$q40',	question41= '$q41',	question42= '$q42',	question43= '$q43',	question44= '$q44',	question45= '$q45',	question46= '$q46',	question47= '$q47',	question48= '$q48',	question49= '$q49',	question50= '$q50',	question51= '$q51',	question52= '$q52',	question53= '$q53',	question54= '$q54',	question55= '$q55',	question56= '$q56',	question57= '$q57',	question58= '$q58',	question59= '$q59',	question60 = '$q60' WHERE contract_no = '$contract'";

    if(mysqli_query($con, $sql)){
        $act = "Answered Coworker Questionnaire: ".$contract;
        $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','$act')";
        mysqli_query($con,$log);
        header('location: loan_credit_investigation.php?success');
    }else{
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    
}else{
    header('location: loan_credit_investigation.php?failed');
}

// die(isset($_POST['submit_coworker']));

// if(isset($_POST['contract'])){
  
//     // $q61=$_POST['q61']??null;
//     // $q62=$_POST['q62']??null;

   
// }else{
//     header('location: loan_credit_investigation.php?failed');
// }

?>