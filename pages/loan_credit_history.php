<?php
include('../config/conn.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
$id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lending System - Preview</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

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
                        <h1 class="page-header">Credits History</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">

                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <center>
                                            <h3><b>Credits History</b></h3>
                                        </center>
                                        <hr>
                                    </div>
                                    <?php
                                        $applicant = "SELECT * FROM applicants_personal 
                                        LEFT JOIN loan_applications 
                                        ON applicants_personal.applicant_code = loan_applications.client_id
                                        WHERE applicant_code = '$id'";
                                        $applcaintQuery = mysqli_query($con,$applicant);
                                        $rowApp = mysqli_fetch_assoc($applcaintQuery);
                                        ?>
                                    <div class="col-lg-12">

                                        <div class="col-lg-3">
                                            <h4>Borrower:</h4>
                                        </div>
                                        <div class="col-lg-3">
                                            <h4>
                                                <b><?php echo $rowApp['lastname'].", ".$rowApp['firstname']." ".$rowApp['middlename']; ?></b>
                                            </h4>
                                        </div>
                                        <div class="col-lg-3">
                                            <h4>Contract No.:</h4>
                                        </div>
                                        <div class="col-lg-3">
                                            <h4><b><?php echo $rowApp['contract_no'] ?></b></h4>
                                        </div>
                                        <div class="col-lg-3">
                                            <h4>Borrowing History:</h4>
                                        </div>
                                        <div class="col-lg-3">
                                            <?php 
                                                    $query = "SELECT COUNT(client_id) as client_count FROM loan_applications WHERE client_id='$id' AND paid = 1";
                                                    $result = mysqli_query($con, $query);
                                                    $dis = mysqli_fetch_assoc($result);
                                        ?>
                                            <div class="col-lg-3">
                                                <h4><b><?php echo $dis['client_count'];?></b></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <!-- <div class="col-lg-11" style="font-size:15px;"><br>
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
                                        <div class="col-lg-3">Interest (<?=$sched->interestPer?>%):
                                        </div>
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

                                    </div> -->
                                    <div class="col-lg-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="">
                                        <thead>
                                            <tr>
                                                <th>CONTRACT NO.</th>
                                                <th>PROCESSED BY</th>
                                                <th class="text-center">LOAN AMOUNT</th>
                                                <th class="text-center">OUSTANDING BALANCE</th>
                                                <th class="text-center">UDI VALUE</th>
                                                <th class="text-center">LOAN DURATION</th>
                                                <th class="text-center">APPLICATION DATE</th>
                                                <th class="text-center">STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql ="SELECT * FROM applicants_personal 
                                                LEFT JOIN loan_applications 
                                                ON applicants_personal.applicant_code = loan_applications.client_id 
                                                WHERE loan_applications.paid = 1 
                                                ORDER BY applicants_personal.lastname 
                                                ASC";
                                                $result = mysqli_query($con,$sql);
                                                    if(mysqli_num_rows($result) > 0){
                                                        while($row = mysqli_fetch_assoc($result)){
                                                        $cis = $row['client_id'];
                                                       // $loan = new Loan(strval($cid));
                                                       // $name = $row['lastname'].', '.$row['firstname'].' '.$row['middlename'] .' '.$row['suffix'];
                                                        $total = $row['loan_amount'] - $row['total_cashout'];
                                                        $query = "SELECT COUNT(client_id) as client_check FROM loan_applications WHERE paid=1 AND client_id= '$id'";
                                                        $qry_res = mysqli_query($con, $query);
                                                        
                                            ?>
                                            <tr>
                                                <td><?php echo $row['contract_no'];?></td>
                                                <td> <?php echo $row['processed_by']?></td>
                                                
                                                <!-- <td class="text-center">₱<?php echo number_format($total,2);?> -->
                                                <td class="text-center">
                                                    ₱<?php echo number_format($row['loan_amount'],2);?></td>
                                                </td>
                                                <td class="text-center">
                                                    ₱<?php echo number_format($row['ob'],2); ?>
                                                </td>
                                                <td class="text-center">
                                                    ₱<?php echo number_format($row['udi_value'],2); ?>
                                                </td>
                                                <td class="text-center"> <?php echo $row['loan_duration']. ' months'?></td>
                                                <td class="text-center">
                                                    <?php echo date('F d, Y',strtotime($row['application_date']))?>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-warning"> Paid
                                                        <i class="fa fa-thumbs-o-up"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <th>TOTAL</th>
                                                <th class="text-right;"><?php //echo $interest;?></th>
                                                <th class="text-right;">₱
                                                    <?php //echo number_format($monthly*$duration,2);?></th>
                                                <th></th>
                                            </tr> -->
                                            <?php 
                                            } 
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- /.table-responsive -->

                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
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

    <!-- DataTables JavaScript -->
    <script src="../js/dataTables/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/startmin.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    </script>

</body>

</html>

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
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
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
                        <h1><button class="btn btn-md btn-primary" type="button"
                                onclick="{window.open('generate_contract.php?id=<?= $client_id ?>', '_blank');window.open('generate_promissory_note.php?id=<?= $client_id ?>', '_blank');window.open('generate_disclosure.php?id=<?= $client_id ?>', '_blank');window.location.href='loan_approval.php'}"
                                class="btn btn-lg btn-primary"><i class="fa fa-print"></i> Print</button></h1>
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
                                        <!-- <div class="panel panel-primary"> -->
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
                                                        <h4>Date of Application:
                                                            <b><?= $sched->applicationDate ?></b>
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
                                                    <div class="col-lg-3">Interest (<?=$sched->interestPer?>%):
                                                    </div>
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
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label><span style="color:red">* </span>Effective Date</label>
                                                    <input type="date" name="effective_date" class="form-control"
                                                        id="effective_date" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- </div> -->
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
<script type="text/javascript">
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0');
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;
$('#effective_date').attr('min', today);
</script>

</html>