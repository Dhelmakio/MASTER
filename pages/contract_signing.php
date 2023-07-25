<?php
include('../config/conn.php');
include 'mvc/controller/class-autoload.cont.php';
include 'mvc/model/sched.mod.php';

session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}

$client_id;
if(isset($_GET['id'])){
    $client_id=$_GET['id'];
}
if($_GET['cn'] == ""){
    header('location:registry_applicant_view.php');
}

$loan = new Loan($_GET['id']);
$sched = new Schedule($_GET['cn']);

if($loan->incomeEarning > 0){
    // header('location: reg_applicant.php');
}
// var_dump($loan);
//s
$max_loan;
$min_mo;
$max_mo;
$name;
$MA;
$loan_type = "New";
if(isset($_GET['id'])){
    $cid = $_GET['id'];
    $sel = "SELECT * FROM applicants_personal WHERE applicant_code='$cid'";
    $resel = mysqli_query($con,$sel);
    if(mysqli_num_rows($resel) > 0){
    while($rowsel = mysqli_fetch_assoc($resel)) {
        $name = $rowsel['firstname']." ".$rowsel['middlename']." ".$rowsel['lastname']." ".$rowsel['suffix'];
        }
    }
    $sql = "SELECT * FROM applicants_work where applicant_code='$cid'";
    $res = mysqli_query($con,$sql);
    if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)) {
        $max_loan = $row['other_source'];
    }
    }


}else{
    // header('location:loan_application.php');
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

    <title>Lending System - Client Maintenance</title>

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
                    <div class="col-lg-6">
                        <h1 class="page-header">Loan Details</h1>
                    </div>
                    <div class="col-lg-6 text-right">
                        <br>
                        <h1><button class="btn btn-md btn-primary" type="button" onclick="{window.open('generate_contract.php?id=<?= $client_id ?>', '_blank');window.open('generate_promissory_note.php?id=<?= $client_id ?>', '_blank');window.open('generate_disclosure.php?id=<?= $client_id ?>', '_blank');}" class="btn btn-lg btn-primary"><i class="fa fa-print"></i> Print</button></h1>
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
                                                        <center>
                                                            <h3><b>PAYMENT SCHEDULES</b></h3>
                                                        </center>
                                                        <hr>
                                                    </div>
                                                    <?php
                                                     $applicant = "SELECT * FROM applicants_personal WHERE applicant_code = '$cid'";
                                                     $applcaintQuery = mysqli_query($con,$applicant);
                                                     if(mysqli_num_rows($applcaintQuery) > 0){
                                                     while($rowApp = mysqli_fetch_assoc($applcaintQuery)) {
                                                    ?>
                                                    <div class="col-lg-11">
                                                        
                                                        <div class="col-lg-3">
                                                            <h4>Name of Borrower:</h4>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h4>
                                                                <b><?php echo $rowApp['lastname']." ".$rowApp['firstname']." ".$rowApp['middlename']; ?></b>
                                                            </h4>
                                                        </div>
                                                        
                                                        <div class="col-lg-3" align="right">
                                                            <h4>Date of Application: <b><?= $sched->applicationDate ?></b>
                                                            </h4>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h4>Contract No.:</h4>
                                                        </div>
                                                        <div class="col-lg-3">
                                                        <h4><b><?php echo $_GET['cn'] ?></b></h4>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <br><br>
                                                    <div class="col-lg-11" style="font-size:15px;"><br>
                                                        <div class="col-lg-3">Employee Status: </div>
                                                        <div class="col-lg-3"><label>
                                                                <?php echo $loan->clientEmpStatus; ?></label></div>
                                                        <div class="col-lg-3">Principal: </div>
                                                        <div class="col-lg-3"><label>₱
                                                                <?php echo number_format(floatval($sched->principal), 2); ?></label>
                                                        </div>
                                                        <div class="col-lg-3">Income Earning: </div>
                                                        <div class="col-lg-3"><label>
                                                                <?php echo $loan->incomeEarning; ?></label></div>
                                                        <div class="col-lg-3">Interest (<?=$sched->interestPer?>%): </div>
                                                        <div class="col-lg-3"><label>₱
                                                                <?php echo number_format(floatval($sched->interestVal), 2); ?>
                                                        </div>
                                                        <div class="col-lg-3">Borrowing History: </div>
                                                        <div class="col-lg-3"><label>
                                                                <?php echo $loan->borrowingHistCount; ?></label></div>
                                                        <div class="col-lg-3">Notarial Fee: </div>
                                                        <div class="col-lg-3"><label>₱
                                                                <?php echo number_format(floatval($sched->notarial), 2); ?></label>
                                                        </div>
                                                        <div class="col-lg-3">Loan Type: </div>
                                                        <div class="col-lg-3"><label>
                                                                <?= $sched->loanType ?></label>
                                                        </div>
                                                        <div class="col-lg-3">Amortization Frequency: </div>
                                                        <div class="col-lg-3"><label>
                                                                <?= $sched->amortFrequency.'LY' ?></label>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-12">
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                   <?= $sched->loadTable(); ?>
                                                </div>
                                            </div>
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

</body>
<?php require_once('footer.php'); ?>

</html>