<?php
include('../config/conn.php');
// include 'mvc/controller/class-autoload.cont.php';

session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}

// $loan = new Loan($_POST['id']);

// // var_dump($loan);

// $max_loan;
// $min_mo;
// $max_mo;
// $name;
// $loan_type;
$contract;
$name;
$date_answered;

if(isset($_GET['id'])){
    $contract = $_GET['id'];

    $sql = "select concat(applicants_personal.firstname,' ',applicants_personal.middlename,' ',applicants_personal.lastname,' ',applicants_personal.suffix) as name, loan_applications.* from loan_applications inner join applicants_personal on applicants_personal.applicant_code = loan_applications.client_id where contract_no='$contract'";
    $res = mysqli_query($con,$sql);
    if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)) {
            $name = $row['name'];
            // $name = $row['name'];
        }
    }

}else{
    header('location:loan_credit_investigation.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Lending System - Credit Investigation</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <?php include('nav.php');?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Credit Investigation</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="panel tabbed-panel panel-default">
                               
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <!-- Page 1 -->
                                        <div class="tab-pane fade in active" id="tab-default-1">
                                        <!-- <h3>Loan Application</h3> -->
                                        <div class="panel panel-primary">
                                            <!-- <div class="panel-heading">
                                                Personal Information
                                            </div> -->
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <center><h3><b>Credit Investigation | Questionnaire</b></h3></center>
                                                        <hr>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-4">
                                                            <h5>Name of Borrower: &nbsp;<b><?php echo $name;?></b></h5>
                                                        </div>
                                                        <div class="col-lg-4" align="right">
                                                            <h5>Contract No.: <b><?php echo $contract;?></b></h5>
                                                        </div>
                                                        <div class="col-lg-4" align="right">
                                                            <h5>Date: <b><?php echo date('F d, Y');?></b></h5>
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                    
                                                    <div class="col-lg-12"><hr></div>

                                                    <div class="col-lg-12"><i style="color:red;">NOTE: All fields are required.</i><br><br></div>

                                                    <!-- <form role="form" action="save_questionnaire_process.php" method="post"> -->
                                                    <input type="text" name="contract" value="<?php echo $contract?>" hidden>
                                                    <!-- <input type="text" name="client_id" value="<?php echo $cid?>" hidden> -->
                                                        
                                                    <!-- Relative -->
                                                    <div class="col-lg-12" align="center"><hr><h4>Questionnaire | For Relative</h4></div>
                                                    <?php
                                                        $questions = "select * From questions order by question_id asc limit 30";
                                                        $qres = mysqli_query($con,$questions);
                                                        if(mysqli_num_rows($qres) > 0){
                                                            while($row = mysqli_fetch_assoc($qres)) {
                                                                ?>
                                                                    <div class="col-lg-12">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label><?php echo $row['question_id']?>. <?php echo $row['question']?></label>
                                                                                <input type="text" class="form-control" name="q<?php echo $row['question_id']?>" value="<?php 
                                                                                    $answer = "select * from answers where contract_no='$contract'";
                                                                                    $res_ans = mysqli_query($con,$answer);
                                                                                    if(mysqli_num_rows($res_ans) > 0){
                                                                                        while($row2 = mysqli_fetch_assoc($res_ans)) {
                                                                                            echo $row2['question'.$row['question_id']];
                                                                                        }
                                                                                    }
                                                                                ?>" disabled required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                    <!-- $questions = "select * From questions where question_id>29 order by question_id asc "; -->
                                                    <div class="col-lg-12" align="center"><hr><h4>Questionnaire | For Co-worker</h4></div>
                                                    <?php
                                                        $questions = "select * From questions where question_id>30 order by question_id asc ";
                                                        $qres = mysqli_query($con,$questions);
                                                        if(mysqli_num_rows($qres) > 0){
                                                            while($row = mysqli_fetch_assoc($qres)) {
                                                                ?>
                                                                    <div class="col-lg-12">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label><?php echo $row['question_id']?>. <?php echo $row['question']?></label>
                                                                                <input type="text" class="form-control" name="q<?php echo $row['question_id']?>" value="<?php 
                                                                                    $answer = "select * from answers where contract_no='$contract'";
                                                                                    $res_ans = mysqli_query($con,$answer);
                                                                                    if(mysqli_num_rows($res_ans) > 0){
                                                                                        while($row2 = mysqli_fetch_assoc($res_ans)) {
                                                                                            echo $row2['question'.$row['question_id']];
                                                                                        }
                                                                                    }
                                                                                ?>" disabled required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                    <div class="col-lg-12" align="center"><br>
                                                        <a href="loan_credit_investigation_pass.php?contract=<?php echo $contract?>">
                                                            <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Pass">
                                                                <i class="fa fa-check" aria-hidden="true">Pass</i>
                                                            </button>
                                                        </a>
                                                        <a href="loan_credit_investigation_fail.php?contract=<?php echo $contract?>">
                                                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Fail">
                                                                <i class="fa fa-times" aria-hidden="true">Fail</i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                        
                                                    <!-- </form> -->
                                                    
                                                </div>
                                                <!-- /.row (nested) -->
                                            </div>
                                            <!-- /.panel-body -->
                                        </div>
                                        <!-- /.panel -->

                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel -->
                        </div>
                        <div class="col-lg-12">
                            
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>
        <script>

            

            

        </script>

    </body>
</html>
