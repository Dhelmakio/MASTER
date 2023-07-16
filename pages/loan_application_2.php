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
                                                        <center><h3><b><?php echo $loan_type;?></b></h3></center>
                                                        <hr>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-6">
                                                            <h4>Name of Borrower: &nbsp;<b><?php echo $name;?></b></h4>
                                                        </div>
                                                        <div class="col-lg-6" align="right">
                                                            <h4>Date of Application: <b><?php echo date('F d, Y');?></b></h4>
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                    <div class="col-lg-8" style="font-size:15px;"><br>
                                                        <div class="col-lg-3">Employee Status: </div>
                                                        <div class="col-lg-3"><label> <?php echo $loan->clientEmpStatus; ?></label></div>
                                                        <div class="col-lg-3">Net Salary per Month: </div>
                                                        <div class="col-lg-3"><label>₱ <?php echo $loan->monthlyNetSal; ?></label></div>
                                                        <div class="col-lg-3">Income Earning: </div>
                                                        <div class="col-lg-3"><label> <?php echo $loan->incomeEarning; ?></label></div>
                                                        <div class="col-lg-3">Minimum Sukli: </div>
                                                        <div class="col-lg-3"><label>₱ <?php echo $loan->clientSukli; ?></div>
                                                        <div class="col-lg-3">Borrowing History: </div>
                                                        <div class="col-lg-3"><label> <?php echo $loan->borrowingHistCount; ?></label></div>
                                                        <div class="col-lg-3">Net Loanable per month: </div>
                                                        <div class="col-lg-3"><label>₱ <?php echo $loan->netLoanPerMonth; ?></label></div>
                                                        
                                                    </div>
                                                    <div class="col-lg-12"><hr></div>

                                                    <div class="col-lg-12"><i style="color:red;">NOTE: All fields are required.</i><br><br></div>

                                                    <form role="form" action="loan_application_process.php" method="post">
                                                        <!-- hidden inputs -->
                                                        
                                                        <input type="text" name="client_id" value="<?php echo $cid?>" hidden>
                                                        <input type="text" name="mamort" id="mamort" value="" hidden>
                                                        <input type="text" name="lid" id="" value="<?php echo $lid?>" hidden>
                                                        <input type="text" name="ltype" value="<?php echo $loan_type?>" hidden>

                                                        <?php
                                                            $mo_int;
                                                            $variation = $loan->clientEmpStatus;
                                                            $max_month;
                                                                if($variation == "REGULAR"){
                                                                    $max_month = 3;
                                                                }else{
                                                                    $max_month = 2;
                                                                }
                                                            // if(mysqli_num_rows($res) > 0){
                                                                // while($row = mysqli_fetch_assoc($res)) {
                                                                    ?>

                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label>Loan Duration </label>
                                                                        <input class="form-control" id="months" type="number" name="duration" min="1" max="<?php echo $max_month?>" placeholder=""?>
                                                                        <input hidden type="text" id="months_" name="months_" value="">
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
                                                        <input type="text" id="max_dur" value="<?php echo $max_month?>" hidden>

                                                        <div class="col-lg-4">
                                                            <div class="form-group" id="loan-amnt-section" style="visibility:hidden">
                                                                <label>Loan Amount (₱) </label>
                                                                
                                                                <input type="number" id="lamt" class="form-control" style="text-align:right;" step="0.01" min="1" max="<?php echo $max_loan?>" name="loan_amt" placeholder="Loan Amount" required>
                                                                <input hidden type="text" id="lamt_" name="lamt_" value="">
                                                                <i id="max-loanable" style="color:red;"></i>
                                                                
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-lg-4">
                                                            <div class="form-group" id="cash-out-section" style="visibility:hidden">
                                                                <label>Desired Cash-out (₱) </label>
                                                                <input type="number" id="cout" class="form-control" style="text-align:right;" step="0.01" min="1" max="<?php echo $max_loan?>" name="cout" placeholder="Cash-out" required>
                                                                <i id="max-loanable" style="color:red;"></i>
                                                            </div>
                                                        </div> -->
                                                        
                                                        <div class="col-lg-12" align="right">
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-success" onclick="calculate()">
                                                                    <i class="fa fa-plus" aria-hidden="true" title="Copy to use user-plus"></i> Calculate
                                                                </button>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="calculation" class="col-lg-12" style="display:none;">
                                                                <br><div class="col-lg-12" style="border-top: 2px solid black;"></div><br><br><br>
                                                                
                                                            <div class="col-lg-6" align="left">
                                                                <!-- <h4><b>Loan Details:</b></h4><br> -->
                                                                <center><h5><b><u>LOAN SUMMARY:</u></b></h5></center><br><br>
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Principal (₱):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number" name="loan_amount_" class="form-control" step="0.01" id="loan_amount_" value="" disabled style="color:blue;text-align:right">
                                                                            <!-- <input hidden type="text" name="interest" id="interest-amount" value="" style="text-align:right"> -->
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
                                                                            <input type="number" name="interest_" class="form-control" step="0.01" id="interest-amount_" value="" disabled style="color:red;text-align:right">
                                                                            <input hidden type="text" name="interest" id="interest-amount" value="" style="text-align:right">
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
                                                                            <input type="number" name="notarial_" class="form-control" step="0.01" id="notarial-fee_" value="" disabled style="color:red;text-align:right">
                                                                            <input type="text" name="notarial" id="notarial-fee" value="" hidden style="text-align:right">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12" style="border-top: 2px solid gray;"></div>
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
                                                                <div class="col-lg-12">
                                                                    <Br>
                                                                    <!-- <h4><b>Cashout:</b></h4><br> -->
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Total Cashout (₱):</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input type="number" style="color:blue;text-align:right;font-weight:bold;" name="cashout_" class="form-control" step="0.01" id="total-cashout_" style="text-align:right" value="" disabled>
                                                                            <input type="text" name="cashout" id="total-cashout" style="text-align:right" value="" hidden>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12"><br>
                                                                <center><h5><b><u>PAYMENT OPTIONS:</u></b></h5></center><br>
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Monthly (₱):<input type="radio" name="mop" id="mop" value="1" ></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input style="color:red;text-align:right;" type="number" name="amortization_" class="form-control" step="0.01" id="collection-per-cut_" style="text-align:right" value="" disabled>
                                                                            <input type="text" name="amortization" id="collection-per-cut" style="text-align:right" value="" hidden>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="col-lg-6" align="right">
                                                                        <div class="form-group">
                                                                            <label>Semi-monthly (₱):<input type="radio" name="mop" id="mop" value="2" ></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <input style="color:red;text-align:right;" type="number" name="amortization_2" class="form-control" step="0.01" id="collection-per-cut_2" style="text-align:right" value="" disabled>
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
                                                                            <input style="color:red;text-align:right;" type="number" name="amortization_3" class="form-control" step="0.01" id="collection-per-cut_3" style="text-align:right" value="" disabled>
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
                                                            </div><br><br><hr>
                                                            <div class="col-lg-6" align="center" style="visibility:hidden;" id="submit_btn"><br>
                                                                <button onclick="" class="btn btn-primary" name="submit">
                                                                    <i class="fa fa-plus" aria-hidden="true" title="Copy to use save"></i> Submit Application
                                                                </button>
                                                                <br><br>
                                                                <!-- <button onclick="window.location.href = 'loan_application_2.php';" class="btn btn-primary" name="reset">
                                                                    <i class="fa fa-plus" aria-hidden="true" title="Copy to use save"></i> Submit Application
                                                                </button> -->
                                                                <!-- <button type="reset" class="btn btn-warning">Reset Button</button> -->
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

            let duration;
            let maxLoanAmount;
            var maxdur = document.getElementById("max_dur").value;

            $( "#months" ).change(function() {
                if($("#months").val() > 0 && $("#months").val() <= maxdur){
                    $('#loan-amnt-section').attr('style','visibility: visible');
                    $("#lamt").focus();
                    $('#cash-out-section').attr('style','visibility: visible');
                    // $("#cout").focus();
                }else{
                    $('#loan-amnt-section').attr('style','visibility: hidden');
                    
                    alert("Invalid duration entry. Please try again.");
                    $("#months").val('');
                    $("#months").focus();
                    // document.getElementById("months").value() ="0";
                    
                }

                duration = $("#months").val();
                maxLoanAmount = duration * <?php echo $loan->netLoanPerMonth; ?>;

                $("#max-loanable").text("Maximum Loanable for desired duration: ₱ "+maxLoanAmount);

                $('#lamt').val('');
            });
            
            function calculate(){
            // if($("#lamt").val() != 0 && $("#cout").val() == 0 ){
                if($("#lamt").val() > maxLoanAmount ){
                    alert('Loan amount is greater than the Maximum Loanable: ' + maxLoanAmount);
                }else{
                    document.getElementById("submit_btn").style.visibility="visible";
                    var x = document.getElementById("lamt").value;
                    var y = document.getElementById("months").value;

                    if(x != "" && y != ""){
                        // alert(mo_amt);
                        document.getElementById('calculation').style.display = "block";
                        
                        // alert($loan->moInterest+"");
                        let interestAmount = ($("#lamt").val() * <?php echo $loan->moInterest; ?>) * duration;
                        let notarialFee = <?php echo Statics::$NOTARIALFEE; ?>;
                        let totalDeductions = interestAmount + notarialFee;
                        let totalCashout = $("#lamt").val() - totalDeductions;
                        let collectionPerCut = $("#lamt").val() / (duration);
                        let collectionPerCut2 = ($("#lamt").val() / (duration))/2;
                        let collectionPerCut3 = ($("#lamt").val() / (duration))/4;

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
                        

                    }else{
                        alert("Please fill required fields.");
                    }
                    window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });
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
