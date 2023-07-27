<?php
include('../config/conn.php');
include 'mvc/controller/class-autoload.cont.php';

session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}

$client_id;
if(isset($_POST['id'])){
    $client_id=$_POST['id'];
}

$loan = new Loan($_POST['id']);


// var_dump($loan);

$max_loan;
$min_mo;
$max_mo;
$name;
$loan_type = $_POST['loan_type'];
if(isset($_POST['id'])){
    $cid = $_POST['id'];
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
        $max_loan = $row['max_loanable_amt'];
    }
    }

    // $lid = $_POST['loan_type'];
    // $loan_type = "NEW";
    // $sql = "SELECT * FROM loan_types where loan_type_id='$lid'";
    // $res = mysqli_query($con,$sql);
    // if(mysqli_num_rows($res) > 0){
    // while($row = mysqli_fetch_assoc($res)) {
    //     $min_mo = $row['min'];;
    //     $max_mo = $row['max'];;
    //     $loan_type = $_POST['loan_type'];
    // }
    // }

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
                    <div class="col-lg-12">
                        <h1 class="page-header">Loan Application</h1>
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
                                                            <h3><b><?php echo $loan_type;?></b></h3>
                                                        </center>
                                                        <hr>
                                                    </div>
                                                    <?php
                                                     $applicant = "SELECT * FROM applicants_personal WHERE applicant_code = '$cid'";
                                                     $applcaintQuery = mysqli_query($con,$applicant);
                                                     if(mysqli_num_rows($applcaintQuery) > 0){
                                                     while($rowApp = mysqli_fetch_assoc($applcaintQuery)) {
                                                    ?>
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-8">
                                                            <h4>Name of Borrower:
                                                                &nbsp;<b><?php echo $rowApp['lastname']." ".$rowApp['firstname']." ".$rowApp['middlename']; ?></b>
                                                            </h4>
                                                        </div>
                                                        <div class="col-lg-4" align="right">
                                                            <h4>Date of Application: <b><?php echo date('F d, Y');?></b>
                                                            </h4>
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
                                                        <div class="col-lg-3">Net Salary per Month: </div>
                                                        <div class="col-lg-3"><label>₱
                                                                <?php echo number_format(floatval( $loan->monthlyNetSal), 2) ?></label></div>
                                                        <div class="col-lg-3">Income Earning: </div>
                                                        <div class="col-lg-3"><label>
                                                                <?php echo $loan->incomeEarning; ?></label></div>
                                                                <div class="col-lg-3">Borrowing History: </div>
                                                        <div class="col-lg-3"><label>
                                                                <?php echo $loan->borrowingHistCount; ?></label></div>

                                                    </div>
                                                    <div class="col-lg-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-lg-11" style="font-size:15px;"><br>
                                                        <div class="col-lg-3">Contract No.: </div>
                                                        <div class="col-lg-3"><label>
                                                                <?php echo $loan->contractNo; ?></label></div>
                                                        <div class="col-lg-3">Outstanding Balance: </div>
                                                        <div class="col-lg-3"><label>₱
                                                                <?php echo number_format(floatval($loan->outStandingBalance), 2); ?></label></div>
                                                        

                                                    </div>
                                                    <div class="col-lg-12">
                                                        <hr>
                                                    </div>


                                                    <div class="col-lg-12"><i style="color:red;">NOTE: All fields are
                                                            required.</i><br><br></div>

                                                    <form role="form" action="loan_application_process.php"
                                                        method="post">
                                                        <!-- hidden inputs -->

                                                        <input type="text" name="client_id" value="<?php echo $cid?>"
                                                            hidden>
                                                        <input type="text" name="mamort" id="mamort" value="" hidden>
                                                        <input type="text" name="lid" id="" value="<?php echo $lid?>"
                                                            hidden>
                                                        <input type="text" name="ltype" value="<?php echo $loan_type?>"
                                                            hidden>
                                                        <input type="text" name="interest_percentage" id="interest_percentage"
                                                            hidden>
                                                        
                                                        <input type="text" name="udi_percentage"  id="udi_percentage"
                                                            hidden>
                                                        
                                                           

                                                        <?php
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
                                                                }else if($variation == "CASUAL" && strtoupper($loan->incomeEarning) == "SINGLE"){
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

                                                                $max_loan = $MA * $max_month;
                                                            // if(mysqli_num_rows($res) > 0){
                                                                // while($row = mysqli_fetch_assoc($res)) {
                                                                    ?>

                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>UDI (%) </label>

                                                                <input type="number" id="udi" class="form-control"
                                                                    step="0.01" min="1" max="<?php echo $max_loan?>"
                                                                    name="udi" placeholder="UDI Percent" required>
                                                                <input hidden type="text" id="udi_" name="udi_"
                                                                    value="">
                                                                <!-- <i id="max-loanable" style="color:red;"></i>
                                                                &nbsp;&nbsp;&nbsp; Use maximum loanable?
                                                                <input type="checkbox" id="use-max" value=""> -->

                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="form-group" id="term-section" style="visibility:hidden">
                                                                <label>Loan Duration </label>
                                                                <!-- <input class="form-control" id="months" type="number" name="duration" min="1" max="<?php echo $max_month?>" placeholder=""?> -->
                                                                <input hidden type="text" id="months_" name="months_"
                                                                    value="">
                                                                <select class="form-control" name="duration"
                                                                    id="months">
                                                                    <option value="" selected disabled>SELECT</option>
                                                                    <?php 
                                                                            for($index = 0; $index < $max_month; $index++){
                                                                                echo '<option value="'.($index+1).'">'.($index+1).'</option>';
                                                                            }
                                                                            ?>
                                                                </select>
                                                                <i style="color:red;">
                                                                    <?php 
                                                                                    echo "Maximum duration: ".$max_month." mos.";
                                                                                ?>
                                                                </i>
                                                            </div>
                                                        </div>

                                                        <?php
                                                                    // $interest_ = new getInterestRate();
                                                                    $mo_int = $loan->getInterestRate()
                                                                    // echo $loan->moInterest;
                                                                    
                                                                // }

                                                            // }
                                                        ?>
                                                        <!-- max_duration -->
                                                        <input type="text" id="max_dur" value="<?php echo $max_month?>"
                                                            hidden>

                                                        <div class="col-lg-4">
                                                            <div class="form-group" id="loan-amnt-section"
                                                                style="visibility:hidden">
                                                                <label>Loan Amount (₱) </label>

                                                                <input type="number" id="lamt" class="form-control text-right"
                                                                    step="0.01" min="1" max="<?php echo $max_loan?>"
                                                                    name="loan_amt" placeholder="Loan Amount" required>
                                                                <input hidden type="text" id="lamt_" name="lamt_"
                                                                    value="">
                                                                <i id="max-loanable" style="color:red;"></i>
                                                                &nbsp;&nbsp;&nbsp; Use maximum loanable?
                                                                <input type="checkbox" id="use-max" value="">

                                                            </div>
                                                        </div>


                                                        <div class="col-lg-12" align="right">
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-success"
                                                                    onclick="calculate()">
                                                                    <i class="fa fa-plus" aria-hidden="true"
                                                                        title="Copy to use user-plus"></i> Calculate
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div id="calculation" class="col-lg-12" style="display:none;">
                                                            <br>
                                                            <div class="col-lg-12" style="border-top: 2px solid black;">
                                                            </div><br><br><br>

                                                            <div class="col-lg-6" align="left">
                                                                <!-- <h4><b>Loan Details:</b></h4><br> -->
                                                                <center>
                                                                    <h5><b><u>LOAN SUMMARY:</u></b></h5>
                                                                </center><br><br>
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Principal (₱):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number" name="loan_amount_"
                                                                                class="form-control" step="0.01"
                                                                                id="loan_amount_" value="" disabled
                                                                                style="color:blue;text-align:right">
                                                                            <!-- <input hidden type="text" name="interest" id="interest-amount" value="" style="text-align:right"> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Interest Amount
                                                                                (<i><?php echo $loan->getInterestRate()*100;?>%</i>):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number" name="interest_"
                                                                                class="form-control" step="0.01"
                                                                                id="interest-amount_" value="" disabled
                                                                                style="color:red;text-align:right">
                                                                            <input hidden type="text" name="interest"
                                                                                id="interest-amount" value=""
                                                                                style="text-align:right">
                                                                        </div>
                                                                    </div>

                                                                </div> -->
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Term (Months):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number" name="term_"
                                                                                class="form-control" step="0.01"
                                                                                id="term_" value="" disabled
                                                                                style="color:red;text-align:right">
                                                                            <input type="text" name="term" id="term"
                                                                                value="" hidden
                                                                                style="text-align:right">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>UDI (<span
                                                                                    id="udiper"></span>%):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number" name="prevudi"
                                                                                class="form-control" step="0.01"
                                                                                id="prevudi" value="" disabled
                                                                                style="color:red;text-align:right">
                                                                            <input type="text" name="prevudi_" id="prevudi_"
                                                                                value="" hidden
                                                                                style="text-align:right">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Processing Fee (<span
                                                                                    id="pfper"></span>%):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number"
                                                                                name="processing_value_"
                                                                                class="form-control" step="0.01"
                                                                                id="processing_value_" value="" disabled
                                                                                style="color:red;text-align:right">
                                                                            <input type="text" name="processing_value"
                                                                                id="processing_value" value="" hidden
                                                                                style="text-align:right">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Collection Fee (<span
                                                                                    id="cfper"></span>%):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number"
                                                                                name="collection_value_"
                                                                                class="form-control" step="0.01"
                                                                                id="collection_value_" value="" disabled
                                                                                style="color:red;text-align:right">
                                                                            <input type="text" name="collection_fee"
                                                                                id="collection_fee" value="" hidden
                                                                                style="text-align:right">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Notarial Fee (₱):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number" name="notarial_"
                                                                                class="form-control" step="0.01"
                                                                                id="notarial-fee_" value="" disabled
                                                                                style="color:red;text-align:right">
                                                                            <input type="text" name="notarial"
                                                                                id="notarial-fee" value="" hidden
                                                                                style="text-align:right">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Total Deduction (₱):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number" name="total_deduction_"
                                                                                class="form-control" step="0.01"
                                                                                id="total_deduction_" value="" disabled
                                                                                style="color:red;text-align:right">
                                                                            <input type="text" name="total_deduction"
                                                                                id="total_deduction" value="" hidden
                                                                                style="text-align:right">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12"
                                                                    style="border-top: 2px solid gray;"></div>
                                                                <!-- <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Total Deductions (₱):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number" name="deduction_" class="form-control" step="0.01" id="total-ded_" value="" disabled style="color:red;text-align:right">
                                                                            <input type="text" name="deduction" id="total-ded" value="" hidden style="text-align:right">
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                                <!-- <div class="col-lg-12">
                                                                    <Br>
                                                                    
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Total Cashout (₱):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number"
                                                                                style="color:blue;text-align:right;font-weight:bold;"
                                                                                name="cashout_" class="form-control"
                                                                                step="0.01" id="total-cashout_"
                                                                                style="text-align:right" value=""
                                                                                disabled>
                                                                            <input type="text" name="cashout"
                                                                                id="total-cashout"
                                                                                style="text-align:right" value=""
                                                                                hidden>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                                <div class="col-lg-12">
                                                                    <Br>
                                                                    <!-- <h4><b>Cashout:</b></h4><br> -->
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Proceeds of Loan (₱):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number"
                                                                                style="color:blue;text-align:right;font-weight:bold;"
                                                                                name="init_cashout_" class="form-control"
                                                                                step="0.01" id="init_cashout_"
                                                                                style="text-align:right" value=""
                                                                                disabled>
                                                                            <input type="text" name="init_cashout"
                                                                                id="init_cashout" style="text-align:right"
                                                                                value="" hidden>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Outstanding Balance (₱):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number"
                                                                                name="outstanding_balance_"
                                                                                class="form-control" step="0.01"
                                                                                id="outstanding_balance_"
                                                                                value=""
                                                                                disabled
                                                                                style="color:red;text-align:right">
                                                                            <input type="text"
                                                                                name="outstanding_balance"
                                                                                id="outstanding_balance" value=""
                                                                                hidden style="text-align:right">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12"
                                                                    style="border-top: 2px solid gray;"></div>
                                                                <div class="col-lg-12">
                                                                    <Br>
                                                                    <!-- <h4><b>Cashout:</b></h4><br> -->
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>New Proceeds of Loan (₱):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number"
                                                                                style="color:blue;text-align:right;font-weight:bold;"
                                                                                name="cashout_" class="form-control"
                                                                                step="0.01" id="cashout_"
                                                                                style="text-align:right" value=""
                                                                                disabled>
                                                                            <input type="text" name="cashout"
                                                                                id="cashout" style="text-align:right"
                                                                                value="" hidden>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12"
                                                                    style="border-top: 2px solid gray;"></div>
                                                                <div class="col-lg-12"><br>
                                                                    <center>
                                                                        <h5><b><u>PAYMENT OPTIONS:</u></b></h5>
                                                                    </center><br>
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Monthly (₱):<input type="radio"
                                                                                    name="mop" id="mop" value="1"
                                                                                     required></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input style="color:red;text-align:right;"
                                                                                type="number" name="amortization_"
                                                                                class="form-control" step="0.01"
                                                                                id="collection-per-cut_"
                                                                                style="text-align:right" value=""
                                                                                disabled>
                                                                            <input type="text" name="amortization"
                                                                                id="collection-per-cut"
                                                                                style="text-align:right" value=""
                                                                                hidden>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Semi-monthly (₱):<input type="radio" checked
                                                                                    name="mop" id="mop"
                                                                                    value="2"></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input style="color:red;text-align:right;"
                                                                                type="number" name="amortization_2"
                                                                                class="form-control" step="0.01"
                                                                                id="collection-per-cut_2"
                                                                                style="text-align:right" value=""
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Weekly (₱):<input type="radio"
                                                                                    name="mop" id="mop"
                                                                                    value="3"></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input style="color:red;text-align:right;"
                                                                                type="number" name="amortization_3"
                                                                                class="form-control" step="0.01"
                                                                                id="collection-per-cut_3"
                                                                                style="text-align:right" value=""
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- right -->
                                                            <div class="col-lg-6" align="left">
                                                                <!-- <h5><b>Preview</b></h5><br> -->
                                                                <!-- <div class="col-lg-6" style="font-size:15px;"><br> -->
                                                                <!-- <div class="col-lg-12"><h5><b>Loan Details: </b></h5></div>
                                                                <div class="col-lg-4" align="right"><i>Monthly Interest Rate: </i></div>
                                                                <div class="col-lg-8"><b><?php //echo $loan->getInterestRate()*100;?>%</b></div>
                                                                <div class="col-lg-4" align="right"><i>Loan Amount: </i></div>
                                                                <div class="col-lg-8">₱ <input type="text" disabled id="prev_loan_amt" style="color:blue;text-align:right" value=""></div>
                                                                <div class="col-lg-4" align="right"><i>Interest Amount: </i></div>
                                                                <div class="col-lg-8">₱ <input type="text" disabled id="prev_int_amt" style="color:red;text-align:right" value=""></div>
                                                                <div class="col-lg-4" align="right"><i>Notarial Fee: </i></div>
                                                                <div class="col-lg-8">₱ <input type="text" disabled id="prev_not_fee" style="color:red;text-align:right" value=""><hr></div>
                                                                <div class="col-lg-4" align="right"><i>Net Cashout: </i></div>
                                                                <div class="col-lg-8">₱ <input type="text" disabled id="prev_cash_out" style="color:blue;text-align:right" value=""><br><br></div>
                                                                <div class="col-lg-12"><b><h5>Payments Terms: </b></h5></div>
                                                                <div class="col-lg-4" align="right"><i>Monthly: </i></div>
                                                                <div class="col-lg-8">₱ <input type="text" disabled id="prev_pay_1" style="color:black;text-align:right" value=""><br></div>
                                                                <div class="col-lg-4" align="right"><i>Semi-monthly: </i></div>
                                                                <div class="col-lg-8">₱ <input type="text" disabled id="prev_pay_2" style="color:black;text-align:right" value=""><br></div>
                                                                <div class="col-lg-4" align="right"><i>Weekly: </i></div>
                                                                <div class="col-lg-8">₱ <input type="text" disabled id="prev_pay_3" style="color:black;text-align:right" value=""><br></div> -->


                                                            </div>
                                                        </div><br><br>
                                                        <hr>
                                                        <div class="col-lg-6" align="center" style="visibility:hidden;"
                                                            id="submit_btn"><br>
                                                            <button onclick="" class="btn btn-primary"
                                                                onclick="return confirm('Please confirm submission of Loan Application.');"
                                                                name="submit">
                                                                <i class="fa fa-plus" aria-hidden="true"
                                                                    title="Copy to use save"></i> Submit Application
                                                            </button>
                                                            <br><br>
                                                            <!-- <button type="button" id="preview-client" class="btn btn-primary">
                                                                    <i class="fa fa-plus" aria-hidden="true" title="Copy to use save"></i> Preview for client
                                                                </button> -->
                                                            <!-- <button type="reset" class="btn btn-warning">Reset Button</button> -->
                                                        </div>
                                                        <div class="col-lg-6" align="center" style="visibility:hidden;"
                                                            id="preview_client_btn"><br>

                                                            <button type="button" id="preview_client"
                                                                class="btn btn-success">
                                                                <i class="fa fa-plus" aria-hidden="true"
                                                                    title="Copy to use save"></i> Preview for client
                                                            </button>
                                                        </div>

                                                </div>
                                                </form>

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
    let duration;
    let maxLoanAmount;
    var maxdur = document.getElementById("max_dur").value;

    $('#udi').change(() => {
        ($('#udi').val() == "") ? $('#term-section').attr('style', 'visibility: hidden') : $('#term-section').attr('style', 'visibility: visible');
        
    });
    
    $("#months").change(function() {
        if ($("#months").val() > 0 && $("#months").val() <= maxdur) {
            $('#loan-amnt-section').attr('style', 'visibility: visible');
            $("#lamt").focus();
            $('#cash-out-section').attr('style', 'visibility: visible');
            // $("#cout").focus();
        } else {
            $('#loan-amnt-section').attr('style', 'visibility: hidden');

            alert("Invalid duration entry. Please try again.");
            $("#months").val('');
            $("#months").focus();
            // document.getElementById("months").value() ="0";

        }

        duration = $("#months").val();
        maxLoanAmount = duration * <?php echo $MA; ?>;

        $("#max-loanable").text("Maximum Loanable for desired duration: ₱ " + maxLoanAmount);
        $('#use-max').click(() => {
            ($('#use-max').is(':checked')) ? $('#lamt').val(maxLoanAmount) + $('#lamt_').val(
                maxLoanAmount): $('#lamt').val("") + $('#lamt_').val("");
        });
        $('#lamt').val('');
    });

    function calculate() {
        // if($("#lamt").val() != 0 && $("#cout").val() == 0 ){
        
        if ($("#lamt").val() > maxLoanAmount) {
            alert('Loan amount is greater than the Maximum Loanable: ' + maxLoanAmount);
        }
         else {

            var x = document.getElementById("lamt").value;
            var y = document.getElementById("months").value;

            if (x != "" && y != "") {
               
                // alert($loan->moInterest+"");
                // let interestAmount = ($("#lamt").val() * <?php echo $loan->moInterest; ?>) * duration;
                let interestAmount = ($("#lamt").val() * <?php echo $loan->moInterest; ?>) ;
                let notarialFee = <?php echo $loan->notarialFee ?>;




                let collectionFeePer = 0.03;
                let processingFeePer = 0.03;
                let collectionFee = $("#lamt").val() * collectionFeePer;
                let processingFee = $("#lamt").val() * processingFeePer;
                let totalDeductions = interestAmount + notarialFee;
                let totalCashout = $("#lamt").val() - totalDeductions;

                // let collectionPerCut = $("#lamt").val() / (duration);
                // let collectionPerCut2 = ($("#lamt").val() / (duration)) / 2;
                // let collectionPerCut3 = ($("#lamt").val() / (duration)) / 4;

                let collectionPerCut = $("#lamt").val() / (duration);
                let collectionPerCut2 = ($("#lamt").val() / (duration)) / 2;
                let collectionPerCut3 = ($("#lamt").val() / (duration)) / 4;

                let udi = ( <?php echo $loan->moInterest * 100 ?>  * duration) - ( (collectionFeePer * 100) + (processingFeePer * 100));
                let udiValue = $("#lamt").val() * ($('#udi').val() / 100);
                let totalDeduction = udiValue + processingFee + collectionFee + notarialFee;
                let proceedLoan = $("#lamt").val() - totalDeduction;
                let newPL = proceedLoan - <?= $loan->outStandingBalance ?>;
               
                 

              
                $("#udi_").val(parseFloat(udiValue).toFixed(2));
                // $("#udi").val(parseFloat(udiValue).toFixed(2));
                $("#outstanding_balance_").val(parseFloat(<?=  $loan->outStandingBalance; ?>).toFixed(2));
                $("#outstanding_balance").val(parseFloat(<?=  $loan->outStandingBalance; ?>).toFixed(2));
                $("#udiper").text($('#udi').val());
                $("#pfper").text(processingFeePer * 100);
                $("#cfper").text(collectionFeePer * 100);

                $("#udi_percentage").val($('#udi').val());
                $('#interest_percentage').val(<?php echo $loan->moInterest * 100 ?>);
               

                $("#prevudi").val(parseFloat(udiValue).toFixed(2));
                $("#prevudi_").val(parseFloat(udiValue).toFixed(2));
                $('#processing_value_').val(parseFloat(processingFee).toFixed(2));
                $('#collection_value_').val(parseFloat(collectionFee).toFixed(2));
                // $("#udi_value_").val(parseFloat(udiValue).toFixed(2));
                // $("#udi_value").val(parseFloat(udiValue).toFixed(2));
                $("#total_deduction_").val(parseFloat(totalDeduction).toFixed(2));
                $("#total_deduction").val(parseFloat(totalDeduction).toFixed(2));

                $("#init_cashout_").val(parseFloat(proceedLoan).toFixed(2));
                $("#innit_cashout").val(parseFloat(proceedLoan).toFixed(2));
                $("#cashout_").val(parseFloat(newPL).toFixed(2));
                $("#cashout").val(parseFloat(newPL).toFixed(2));

                $("#lamt").val(parseFloat(x).toFixed(2));
                $("#loan_amount_").val(parseFloat(x).toFixed(2));
                $("#interest-amount").val(parseFloat(interestAmount).toFixed(2));
                $("#notarial-fee").val(parseFloat(notarialFee).toFixed(2));
                $("#total-ded").val(parseFloat(totalDeductions).toFixed(2));
                $("#total-cashout").val(parseFloat(totalCashout).toFixed(2));
                $("#collection-per-cut").val(parseFloat(collectionPerCut).toFixed(2));
                $("#interest-amount_").val(parseFloat(interestAmount).toFixed(2));
                $("#notarial-fee_").val(parseFloat(notarialFee).toFixed(2));
                $("#total-ded_").val(parseFloat(totalDeductions).toFixed(2));
                $("#total-cashout_").val(parseFloat(totalCashout).toFixed(2));
                $("#collection-per-cut_").val(parseFloat(collectionPerCut).toFixed(2));
                $("#collection-per-cut_2").val(parseFloat(collectionPerCut2).toFixed(2));


                $("#collection-per-cut_3").val(parseFloat(collectionPerCut3).toFixed(2));

                $('#term_').val(duration);
                $('#term').val(duration);

                // PREVIEW

                $("#prev_loan_amt").val(parseFloat(x).toFixed(2));
                $("#prev_int_amt").val(parseFloat(interestAmount).toFixed(2));
                $("#prev_not_fee").val(parseFloat(notarialFee).toFixed(2));
                // $("#total-ded").val(parseFloat(totalDeductions).toFixed(2));
                $("#prev_cash_out").val(parseFloat(totalCashout).toFixed(2));
                // $("#collection-per-cut").val(parseFloat(collectionPerCut).toFixed(2));
                // $("#interest-amount_").val(parseFloat(interestAmount).toFixed(2));
                // $("#notarial-fee_").val(parseFloat(notarialFee).toFixed(2));
                // $("#total-ded_").val(parseFloat(totalDeductions).toFixed(2));
                // $("#total-cashout_").val(parseFloat(totalCashout).toFixed(2));
                $("#prev_pay_1").val(parseFloat(collectionPerCut).toFixed(2));
                $("#prev_pay_2").val(parseFloat(collectionPerCut2).toFixed(2));
                $("#prev_pay_3").val(parseFloat(collectionPerCut3).toFixed(2));


                document.getElementById('lamt').disabled = true;
                document.getElementById('months').disabled = true;
                document.getElementById('lamt_').value = x;
                document.getElementById('months_').value = y;

                window.scrollTo({
                    left: 0,
                    top: document.body.scrollHeight,
                    behavior: "smooth"
                });


                $("#preview_client").click(() => {
                    let newWin = open("about:blank", "example", "width=0, height=0");
                    newWin.document.write(`
                            <meta charset="utf-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <meta name="description" content="">
                            <meta name="author" content="">

                            <title>Lending System - Client View</title>

                            <!-- Bootstrap Core CSS -->
                            <link href="../css/bootstrap.min.css" rel="stylesheet">

                            <!-- MetisMenu CSS -->
                            <link href="../css/metisMenu.min.css" rel="stylesheet">

                            <!-- Custom CSS -->
                            <link href="../css/startmin.css" rel="stylesheet">

                            <!-- Custom Fonts -->
                            <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
                            <div class="col-lg-6" align="left">
                            <center><h5><b><u>LOAN SUMMARY:</u></b></h5></center><br><br>
                            <div class="col-lg-12">
                                <div class="col-lg-6" align="right">
                                    <div class="form-group">
                                        <label>Principal (₱):</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="number" name="loan_amount_" class="form-control" step="0.01" id="loan_amount_" value="${parseFloat(x).toFixed(2)}" disabled style="color:blue;text-align:right">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6" align="right">
                                    <div class="form-group">
                                        <label>Interest Amount (<i><?php echo $loan->getInterestRate()*100;?>%</i>):</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="number" name="interest_" class="form-control" step="0.01" id="interest-amount_" value="${parseFloat(interestAmount).toFixed(2)}" disabled style="color:red;text-align:right">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6" align="right">
                                    <div class="form-group">
                                        <label>Term (Months):</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="number" name="term_" class="form-control" step="0.01" id="term_" value="${duration}" disabled style="color:red;text-align:right">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6" align="right">
                                    <div class="form-group">
                                        <label>Notarial Fee (₱):</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="number" name="notarial_" class="form-control" step="0.01" id="notarial-fee_" value="${parseFloat(notarialFee).toFixed(2)}" disabled style="color:red;text-align:right">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="border-top: 2px solid gray;"></div>
                                <div class="col-lg-12">
                                <Br>
                                <div class="col-lg-6" align="right">
                                    <div class="form-group">
                                        <label>Total Cashout (₱):</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="number" style="color:blue;text-align:right;font-weight:bold;" name="cashout_" class="form-control" step="0.01" id="total-cashout_" style="text-align:right" value="${parseFloat(newPL).toFixed(2)}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12"><br>
                                <center><h5><b><u>PAYMENT OPTIONS:</u></b></h5></center><br>
                                <div class="col-lg-6" align="right">
                                    <div class="form-group">
                                        <label>Monthly (₱):<input type="radio" name="mop" id="mop" value="1" checked required></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input style="color:red;text-align:right;" type="number" name="amortization_" class="form-control" step="0.01" id="collection-per-cut_" style="text-align:right" value="${parseFloat(collectionPerCut).toFixed(2)}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6" align="right">
                                    <div class="form-group">
                                        <label>Semi-monthly (₱):<input type="radio" name="mop" id="mop" value="2"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input style="color:red;text-align:right;" type="number" name="amortization_2" class="form-control" step="0.01" id="collection-per-cut_2" style="text-align:right" value="${parseFloat(collectionPerCut2).toFixed(2)}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6" align="right">
                                    <div class="form-group">
                                        <label>Weekly (₱):<input type="radio" name="mop" id="mop" value="3" ></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input style="color:red;text-align:right;" type="number" name="amortization_3" class="form-control" step="0.01" id="collection-per-cut_3" style="text-align:right" value="${parseFloat(collectionPerCut3).toFixed(2)}" disabled>
                                    </div>
                                </div>
                            </div>
                            `);

                    // newWin.focus();
                    // newWind.onload = () => {
                    //     let html = 
                    //     `
                    //     <div style="font-size:30px;">WELCOME!</div>
                    //     `;
                    //     newWin.document.body.insertAdjacentHTML('afterbegin', html);
                    // };
                    // newWin.document.write(
                    //     "<script>window.oponer.document.body.innerHTML= 'Test'<\/script>"
                    // );
                });
               
                if(totalDeduction => x){
                    alert('Cannot avail for renewal');
                }else{
                    document.getElementById("submit_btn").style.visibility = "visible";
                    document.getElementById("preview_client_btn").style.visibility = "visible";
                    // alert(mo_amt);
                    document.getElementById('calculation').style.display = "block";
                }
            } else {
                alert("Please fill required fields.");
            }

        }
        // }
        // else if($("#lamt").val() == 0 && $("#cout").val() != 0 ){
        //     if($("#cout").val() > maxLoanAmount ){
        //         alert('Loan amount is greater than the Maximum Loanable: ' + maxLoanAmount);
        //     }else{

        //         var x = document.getElementById("cout").value;
        //         var y = document.getElementById("months").value;

        //         if(x != "" && y != ""){
        //             // alert(mo_amt);
        //             document.getElementById('calculation').style.display = "block";

        //             // alert($loan->moInterest+"");
        //             let interestAmount = ($("#lamt").val() * <?php echo $loan->moInterest; ?>) * duration;
        //             let notarialFee = <?php echo Statics::$NOTARIALFEE; ?>;
        //             let totalDeductions = interestAmount + notarialFee; 
        //             let loanAmount = $("#cout").val() + totalDeductions;
        //             let collectionPerCut = $("#lamt").val() / (duration);
        //             let collectionPerCut2 = ($("#lamt").val() / (duration))/2;
        //             let collectionPerCut3 = ($("#lamt").val() / (duration))/4;

        //             $("#lamt").val(parseFloat(loanAmount).toFixed(2));
        //             $("#loan_amount_").val(parseFloat(x).toFixed(2));
        //             $("#interest-amount").val(parseFloat(interestAmount).toFixed(2));
        //             $("#notarial-fee").val(parseFloat(notarialFee).toFixed(2));
        //             $("#total-ded").val(parseFloat(totalDeductions).toFixed(2));
        //             $("#total-cashout").val(parseFloat(totalCashout).toFixed(2));
        //             $("#collection-per-cut").val(parseFloat(collectionPerCut).toFixed(2));
        //             $("#interest-amount_").val(parseFloat(interestAmount).toFixed(2));
        //             $("#notarial-fee_").val(parseFloat(notarialFee).toFixed(2));
        //             $("#total-ded_").val(parseFloat(totalDeductions).toFixed(2));
        //             $("#total-cashout_").val(parseFloat(totalCashout).toFixed(2));
        //             $("#collection-per-cut_").val(parseFloat(collectionPerCut).toFixed(2));
        //             $("#collection-per-cut_2").val(parseFloat(collectionPerCut2).toFixed(2));
        //             $("#collection-per-cut_3").val(parseFloat(collectionPerCut3).toFixed(2));

        //             // PREVIEW

        //             $("#prev_loan_amt").val(parseFloat(x).toFixed(2));
        //             $("#prev_int_amt").val(parseFloat(interestAmount).toFixed(2));
        //             $("#prev_not_fee").val(parseFloat(notarialFee).toFixed(2));
        //             $("#prev_cash_out").val(parseFloat(totalCashout).toFixed(2));
        //             $("#prev_pay_1").val(parseFloat(collectionPerCut).toFixed(2));
        //             $("#prev_pay_2").val(parseFloat(collectionPerCut2).toFixed(2));
        //             $("#prev_pay_3").val(parseFloat(collectionPerCut3).toFixed(2));


        //             document.getElementById('lamt').disabled = true;
        //             document.getElementById('months').disabled = true;
        //             document.getElementById('lamt_').value = x;
        //             document.getElementById('months_').value = y;

        //         }else{
        //             alert("Please fill required fields.");
        //         }
        //     }
        // }

    }
    </script>

</body>

</html>