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

    $mo_int;
    $variation = $loan->clientEmpStatus;
    $max_month;
        if($variation == "REGULAR" && strtoupper($loan->incomeEarning) == "MULTIPLE"){
            if($loan->borrowingHistCount > 5){
                $max_month = 6; 
            }else {
                $max_month = 4; 
            }
            $MA = Statics::$MULTIPLEREGULARAMORT;
        }else  if($variation == "REGULAR" && strtoupper($loan->incomeEarning) == "SINGLE"){
            if($loan->borrowingHistCount > 5){
                $max_month = 6; 
            }else {
                $max_month = 4; 
            }
            $MA = Statics::$SINGLEREGULARAMORT;
        }
        else if($variation == "CASUAL" && strtoupper($loan->incomeEarning) == "MULTIPLE"){
            $max_month = 3;
            $MA = Statics::$MULTIPLECASUALAMORT;
        } else if($variation == "CASUAL" && strtoupper($loan->incomeEarning) == "SINGLE"){
            $max_month = 3;
            $MA = Statics::$SINGLECASUALAMORT;
        }else if($variation == "PROBATIONARY" && strtoupper($loan->incomeEarning) == "MULTIPLE"){
            $max_month = 3;
            $MA = Statics::$MULTIPLECASUALAMORT;
        }else if($variation == "PROBATIONARY" && strtoupper($loan->incomeEarning) == "SINGLE"){
            $max_month = 3;
            $MA = Statics::$SINGLECASUALAMORT;
        }else if($variation == "TRAINEE" && strtoupper($loan->incomeEarning) == "MULTIPLE"){
            $max_month = 3;
            $MA = Statics::$MULTIPLECASUALAMORT;
        }else if($variation == "TRAINEE" && strtoupper($loan->incomeEarning) == "SINGLE"){
            $max_month = 3;
            $MA = Statics::$SINGLECASUALAMORT;
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
    <link href="../css/toast/beautyToast.css" rel="stylesheet">
    <link href="../css/loader.css" rel="stylesheet">
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
        <input type="hidden" id="contract" value="<?= $_GET['cn'] ?>">
        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="page-header">Loan Details</h1>
                    </div>
                    <div class="col-lg-6 text-right">
                        <br>
                        <h1>
                            <button class="btn btn-md btn-primary" type="button" id="reasses"
                                class="btn btn-lg btn-primary"><i class="fa fa-print"></i> Update Loan </button>

                            <button class="btn btn-md btn-primary" type="button" id="print"
                                class="btn btn-lg btn-primary"><i class="fa fa-print"></i> Print Docs</button>

                            <button class="btn btn-md btn-primary" type="button" onclick="process()"
                                class="btn btn-lg btn-primary"><i class="fa fa-print"></i> Process Loan</button>
                        </h1>
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
                                                    <div class="col-lg-3">Employment Status: </div>
                                                    <div class="col-lg-3"><label>
                                                            <?php echo $loan->clientEmpStatus; ?></label></div>
                                                    <div class="col-lg-3">Promissory Note (PN): </div>
                                                    <div class="col-lg-3"><label id='promissory_note'>₱
                                                            <?php echo number_format(floatval($sched->principal), 2); ?></label>
                                                    </div>
                                                    <div class="col-lg-3">Source of Income: </div>
                                                    <div class="col-lg-3"><label>
                                                            <?php echo strtoupper($loan->incomeEarning); ?></label>
                                                    </div>
                                                    <div class="col-lg-3">Interest (<label
                                                            id='interest_percent'><?=$sched->interestPer?></label>%):
                                                    </div>
                                                    <div class="col-lg-3"><label id='udi_value'>₱
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
                                                    <div class="col-lg-3">Collection Fee: </div>
                                                    <div class="col-lg-3"><label id='collection_fee'>₱
                                                            <?php echo number_format((floatval($loan->collectionFee)/100 * floatval($sched->principal)), 2); ?></label>
                                                    </div>
                                                    <div class="col-lg-3">Amortization Frequency: </div>
                                                    <div class="col-lg-3"><label>
                                                            <?= $sched->amortFrequency.'LY' ?></label>
                                                    </div>
                                                    <div class="col-lg-3">Processing Fee: </div>
                                                    <div class="col-lg-3"><label id='processing_fee'>₱
                                                            <?php echo number_format((floatval($loan->processingFee)/100 * floatval($sched->principal)), 2); ?></label>
                                                    </div>
                                                    <div class="col-lg-3">Loan Terms: </div>
                                                    <div class="col-lg-3"><label
                                                            id='loan_terms'><?php echo $sched->duration.' MONTHS'; ?></label>
                                                    </div>
                                                    <div class="col-lg-3">Amortization Amount: </div>
                                                    <div class="col-lg-3"><label id='amortization_amount'>₱
                                                            <?php echo number_format(floatval($sched->amortAmount), 2); ?></label>
                                                    </div>
                                                    <div class="col-lg-3">Minimum Sukli: </div>
                                                    <div class="col-lg-3"><label>₱
                                                            <?php echo number_format(floatval($loan->clientSukli), 2); ?>
                                                    </div>
                                                    <?php 
                                                        if($sched->loanType == 'RENEWAL'){
                                                            echo '<div class="col-lg-3">Outstanding Balance: </div>
                                                            <div class="col-lg-3"><label id="outstanding_balance">₱
                                                                    '.number_format(floatval($loan->outStandingBalance), 2).'</label>
                                                            </div>';
                                                        }
                                                    ?>
                                                    <div class="col-lg-3">Net Loanable per month: </div>
                                                    <div class="col-lg-3"><label>₱
                                                            <?php echo number_format(floatval($loan->netLoanPerMonth), 2); ?></label>
                                                    </div>
                                                    <div class="col-lg-3">Total Cash Out: </div>
                                                    <div class="col-lg-3"><label id="cash_out">₱
                                                            <?php echo number_format(floatval($sched->cashOut), 2); ?></label>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="loanType" value="<?= $sched->loanType ?>">
                                                <div class="col-lg-12">
                                                    <hr>
                                                </div>
                                                <center>
                                                    <div class="orbit"
                                                        style="display:none;top:50%;left:50%;position:absolute;"
                                                        id="orbit">
                                                    </div>
                                                </center>
                                                <div class="col-lg-12" align="left"><b><i style="color:green;">NOTE:
                                                            <?= $sched->ciRemarks ?></i></b><br><br>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12" id="forTableDisplay">

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

    <!-- process modal -->
    <div class="modal fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>
                        <center><i class="fa fa-fw fa-5x" style="color:#337ab7;" aria-hidden="true"
                                title="Copy to use archive">&#xf164</i>
                        </center>
                        <center>
                            <h3>Process Loan?</h3>
                        </center>

                    </p>
                </div>
                <div class="modal-footer" style="padding: 5px;">
                    <!-- <form action="#" method="post">
                        <button type="button" class="btn btn-default text-small" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="id" value="<?=  $display['applicant_code'] ?>">
                        <button type="submit" name="delete" class="btn btn-danger text-small">Yes</button>
                    </form> -->
                    <button type="button" class="btn btn-default text-small" data-dismiss="modal">Cancel</button>

                    <button type="button" id="process" class="btn btn-primary text-small">Confirm</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <!-- recalculation of promissory note -->
    <div class="modal fade text-left" id="recalculation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Update Loan Terms and Promissory Note
                </div>
                <div class="modal-body">

                    <div class="panel tabbed-panel panel-default">
                        <div class="panel-body">
                            <div class="tab-content">
                                <!-- Page 1 -->
                                <div class="tab-pane fade in active" id="tab-default-1">
                                    <div class="panel panel-primary">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Loan Terms </label>
                                                    <select class="form-control" name="duration" id="months">
                                                        <option value="" selected disabled>SELECT</option>
                                                        <?php 
                                                            for($index = 0; $index < $max_month; $index++){
                                                                echo '<option value="'.($index+1).'">'.($index+1).'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    <i style="color:red;">
                                                        <?php echo "Maximum duration: ".$max_month." mos."; ?>
                                                    </i>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group" id="loan-amnt-section"
                                                        style="visibility:hidden">
                                                        <label>Promissory Note (PN) </label>

                                                        <input type="number" id="lamt" class="form-control text-right"
                                                            step="0.01" min="1" max="<?php echo $max_loan?>"
                                                            name="loan_amt" placeholder="Loan Amount" required>
                                                        <input hidden type="text" id="lamt_" name="lamt_" value="">
                                                        <i id="max-loanable" style="color:red;"></i>
                                                        &nbsp;&nbsp;&nbsp; Use maximum loanable?
                                                        <input type="checkbox" id="use-max" value="">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 5px;">

                    <button type="button" class="btn btn-default text-small" data-dismiss="modal">Cancel</button>

                    <button type="button" id="update" class="btn btn-primary text-small">Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/startmin.js"></script>

    <script src="../css/toast/beautyToast.js"></script>

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

<script>
//Process Loan Method
function process() {

    if ($('#effective_date').val() != "") {

        // window.open('generate_contract.php?id=<?= $client_id ?>&contract=<?= $_GET['cn'] ?>', '_blank');
        // window.open('generate_promissory_note.php?id=<?= $client_id ?>&start=' + $('#effective_date').val(), '_blank');
        // window.open('generate_disclosure.php?id=<?= $client_id ?>', '_blank');
        // window.location.href = 'loan_approval.php';

        $('#modal').modal('show');

    } else {

        alert("Effectivity date must be specified.");

    }

}

let objTo = document.getElementById('forTableDisplay');
let divtest = document.createElement("div");

//Effectivity Date
$('#effective_date').change(() => {

    $.ajax({
        type: 'POST',
        url: '../request/req_paysched.php',
        data: {
            contract: $('#contract').val(),
            startDate: $('#effective_date').val()
        },
        dataType: 'json',
        success: (response) => {
            //console.log(response.table);
            divtest.innerHTML = response.table;
            objTo.appendChild(divtest);
        },
        error: (xhr, status, error) => {
            alert(xhr.responseText);
        }
    });

})

//Print Docs
$('#print').click(() => {
    if ($('#effective_date').val() != "") {

        window.open('generate_contract.php?id=<?= $client_id ?>&contract=<?= $_GET['cn'] ?>', '_blank');
        window.open('generate_promissory_note.php?id=<?= $client_id ?>&start=' + $('#effective_date').val(),
            '_blank');
        window.open('generate_disclosure.php?id=<?= $client_id ?>', '_blank');
        //window.location.href = 'loan_approval.php';

        //$('#modal').modal('show');

    } else {

        alert("Effectivity date must be specified.");

    }
});


//Process Loan
$('#process').click(() => {

    $('#orbit').css('display', 'block');
    $('#modal').modal('hide');

    $.ajax({
        type: 'POST',
        url: '../request/req_paysched.php',
        data: {
            contract: $('#contract').val(),
            status: 1
        },
        dataType: 'json',
        success: (response) => {

            setTimeout(() => {

                setTimeout(() => {
                    $('#orbit').css('display', 'none');
                }, 300);
                beautyToast.success({
                    title: '',
                    message: response.msg,
                    darkTheme: false,
                    iconColor: 'green',
                    iconWidth: 24,
                    iconHeight: 24,
                    animationTime: 100,
                });

                setTimeout(() => {
                    window.location.replace(
                        `loan_approval.php`);
                }, 2500);
            }, 2000);
        },
        error: (xhr, status, error) => {
            alert(xhr.responseText);
        }
    });

});

//recalculation
$('#reasses').click(() => {
    $('#recalculation').modal('show');
});

$('#months').change(() => {

    $('#loan-amnt-section').attr('style', 'visibility: visible');
    $("#lamt").focus();

    duration = $("#months").val();
    maxLoanAmount = duration * <?php echo $loan->netLoanPerMonth; ?>;

    $("#max-loanable").text("Maximum Loanable for desired duration: ₱ " + maxLoanAmount);
    $('#use-max').click(() => {
        ($('#use-max').is(':checked')) ? $('#lamt').val(maxLoanAmount) + $('#lamt_').val(
            maxLoanAmount): $('#lamt').val("") + $('#lamt_').val("");
    });

    $("#lamt").val('');

});

$('#update').click(() => {

    if ($('#months').val() == null) {
        $('#recalculation').modal('hide');
        beautyToast.error({
            title: '',
            message: 'Months must be specified.',
            darkTheme: false,
            iconColor: 'red',
            iconWidth: 24,
            iconHeight: 24,
            animationTime: 100,
        });
        setTimeout(() => {
            $('#recalculation').modal('show');
        }, 1000);
    } else if ($('#lamt').val() == '') {
        $('#recalculation').modal('hide');
        beautyToast.error({
            title: '',
            message: 'Promissory note must be specified.',
            darkTheme: false,
            iconColor: 'red',
            iconWidth: 24,
            iconHeight: 24,
            animationTime: 100,
        });
        setTimeout(() => {
            $('#recalculation').modal('show');
        }, 1000);
    } else {
        $('#recalculation').modal('hide');
        $('#orbit').css('display', 'block');


        let notarialFee = <?php echo $loan->notarialFee ?>;
        let monthlyInterest = <?= $sched->monthlyInterest ?> / 100;


        let collectionFeePer = <?= $loan->collectionFee / 100 ?>;
        let processingFeePer = <?= $loan->processingFee / 100 ?>;

        let collectionFee = $("#lamt").val() * collectionFeePer;
        let processingFee = $("#lamt").val() * processingFeePer;


        let collectionPerCut = $("#lamt").val() / (duration);
        let collectionPerCut2 = ($("#lamt").val() / (duration)) / 2;
        let collectionPerCut3 = ($("#lamt").val() / (duration)) / 4;

        let udiValue = (monthlyInterest * duration) * $("#lamt").val();

        let totalDeduction = udiValue + processingFee + collectionFee + notarialFee;
        let proceedLoan = $("#lamt").val() - totalDeduction;

        let newPL = proceedLoan - <?= $loan->outStandingBalance ?>;

        let cashout = ($('#loanType') == 'RENEWAL') ? newPL : proceedLoan;

        if (<?= $sched->mop ?> == 1) {
            amortAmount = collectionPerCut;
        } else if (<?= $sched->mop ?> == 2) {
            amortAmount = collectionPerCut2;
        } else if (<?= $sched->mop ?> == 3) {
            amortAmount = collectionPerCut3;
        }

        if (newPL < 0) {
            beautyToast.error({
                title: '',
                message: 'Promissory note amount is not enough that cause final cash out to a negative value.',
                darkTheme: false,
                iconColor: 'red',
                iconWidth: 24,
                iconHeight: 24,
                animationTime: 100,
            });
        } else {

            $.ajax({
                type: 'POST',
                url: '../request/req_paysched.php',
                data: {
                    update: 1,
                    contract: $('#contract').val(),
                    loan_terms: duration,
                    promissory_note: $("#lamt").val(),
                    udi_value: udiValue,
                    amort_amount: amortAmount,
                    cash_out: cashout
                },
                dataType: 'json',
                success: (response) => {

                    setTimeout(() => {
                        $('#orbit').css('display', 'none');

                        //update preview of loan details
                        $('#loan_terms').text(`${duration} MONTHS`);
                        $('#promissory_note').text(
                            `₱ ${parseFloat($('#lamt').val()).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                            );
                        $('#udi_value').text(
                            `₱ ${parseFloat(udiValue).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                            );
                        $('#collection_fee').text(
                            `₱ ${parseFloat(collectionFee).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                            );
                        $('#processing_fee').text(
                            `₱ ${parseFloat(processingFee).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                            );
                        $('#amortization_amount').text(
                            `₱ ${parseFloat(amortAmount).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                            );
                        $('#cash_out').text(
                            `₱ ${parseFloat(cashout).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                            );

                        beautyToast.success({
                            title: '',
                            message: response.msg,
                            darkTheme: false,
                            iconColor: 'green',
                            iconWidth: 24,
                            iconHeight: 24,
                            animationTime: 100,
                        });
                    }, 1000);

                },
                error: (xhr, status, error) => {
                    alert(xhr.responseText);
                }
            });


        }



    }

});
</script>

</html>