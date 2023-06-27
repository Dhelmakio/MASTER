<?php
include('../config/conn.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
$accid;
$id;
if(isset($_POST['accid'])){
    $id = $_POST['id'];
    $accid = $_POST['accid'];
    $attach1 = addslashes($_FILES['myfile']['tmp_name']);
    if(mkdir("../assets/docs/".$accid."/",0777)){
                        
        $attach1=addslashes($_FILES['myfile']['name']);
        $file_tmp1= $_FILES['myfile']['tmp_name'];
        $info = pathinfo($_FILES['myfile']['name']);
        $ext1 = $info['extension']; 
        $newname = $accid.".".$ext1;
        $target = '../assets/docs/'.$accid.'/'.$newname;
        move_uploaded_file($file_tmp1, $target);

    ?>
        <script type="text/javascript">
        var a = confirm('Proceed to Loan Application?');
        if(a){
            window.location.href = 'loan_application_1.php?id=<?php echo $id;?>';
            <?php //header("location: loan_application_1.php?id=".$id);?>
        }else{
            window.location.href = 'reg_applicant_view.php?id=<?php echo $id;?>';
            <?php //header("location: reg_applicant_view.php?id=".$id); ?>
        }
        </script>
    <?php
         //successfull renewal
    }
}else{
    echo "error";
}
?>