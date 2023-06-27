<?php
include('../config/conn.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}

if(isset($_POST['submit'])){
    $alog_id = $_SESSION['user_id'];
    $alog_name = $_SESSION['name'];
    $id = $_GET['id'];
    $employer = strtoupper($_POST['employer']);
    $emp_type = strtoupper($_POST['emp_type']);
    $nob = strtoupper($_POST['nob']);
    $address = strtoupper($_POST['emp_address']);
    $assloc = strtoupper($_POST['assloc']);
    $position = strtoupper($_POST['position']);
    $hr_personnel = strtoupper($_POST['hr_personnel']);
    $hr_contact = $_POST['hr_contact'];
    // $occupation = strtoupper($_POST['emp_occupation']);
    $date_hired = $_POST['date_hired'];
    $emp_status = strtoupper($_POST['emp_status']);
    $gross = $_POST['gross'];
    $mos = strtoupper($_POST['mos']);
    $bank = strtoupper($_POST['bank']);
    $toa = strtoupper($_POST['toa']);
    $sal_period = $_POST['sal_period'];
    $oloan = strtoupper($_POST['oloan']);
    $osource = strtoupper($_POST['osource']);
    $other_income = $_POST['other_income'];
    
    
    // $max = $other_income;
    $insert = "INSERT INTO employer (client_id,employer_name,employer_type,nature_of_business,address,assigned_location,position,hr_personnel,hr_contact,date_hired,employment_status,gross_monthly,mode_of_salary,bank,type_of_atm,salary_period,other_loan,other_source,other_income) values ('$id','$employer','$emp_type','$nob','$address','$assloc','$position','$hr_personnel','$hr_contact','$date_hired','$emp_status','$gross','$mos','$bank','$toa','$sal_period','$oloan','$osource','$other_income')";
    if(mysqli_query($con,$insert)){
        $act = "Updated employment information of client: ".$id;
        $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','$act')";
        mysqli_query($con,$log);
        header('location: reg_applicant_reference.php?id='.$id);
    }
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

        <title>Lending System - Applicant Information Registry</title>

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
                            <h1 class="page-header">Applicant Information Registry</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel tabbed-panel panel-default">
                                <div class="panel-heading clearfix">
                                    <div class="panel-title pull-left">Registration Form</div>
                                    <div class="pull-right">
                                        <ul class="nav nav-tabs">
                                            <!-- <li class="active"><a href="#tab-default-1" data-toggle="tab">Personal Information I</a></li> -->
                                            <!-- <li><a href="#tab-default-2" data-toggle="tab">Personal Information II</a></li>
                                            <li><a href="#tab-default-3" data-toggle="tab">Applicant's Information</a></li> -->
                                            <!-- <li class="dropdown">
                                                <a href="#" data-toggle="dropdown">More <span class="caret"></span></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#tab-default-4" data-toggle="tab">Page 4</a></li>
                                                    <li><a href="#tab-default-5" data-toggle="tab">Page 5</a></li>
                                                </ul>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <!-- Page 1 -->
                                        <div class="tab-pane fade in active" id="tab-default-1">
                                        <h3>STEP 4: Employment Information</h3>
                                        <div class="panel panel-primary">
                                            <!-- <div class="panel-heading">
                                                Personal Information
                                            </div> -->
                                            <div class="panel-body">
                                                <div class="row">
                                                    <form role="form" action="#" method="post">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Employer / Agency Name</label>
                                                                <input class="form-control" name="employer" placeholder="Employer / Agency Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Employer Type</label>
                                                                <select class="form-control" name="emp_type" required>
                                                                    <option value="" disabled selected=1>SELECT</option>
                                                                    <option value="Government">Government Sector</option>
                                                                    <option value="Private">Private Sector</option>
                                                                    <!-- <option value="Self-employed">Self-employed</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Nature of Business / Type of Business</label>
                                                                <input name="nob" class="form-control" placeholder="Nature of business" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Complete Address</label>
                                                                <input class="form-control" name="emp_address" placeholder="Address" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Assigned Location</label>
                                                                <input class="form-control" name="assloc" placeholder="Assigned Location" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Work Position</label>
                                                                <input class="form-control" name="position" placeholder="Work Position" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>HR / Coordinator / Supervisor Name</label>
                                                                <input name="hr_personnel" class="form-control" placeholder="Human Resource Personnel">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>HR / Coordinator / Supervisor Contact No.</label>
                                                                <input name="hr_contact" class="form-control" placeholder="Human Resource Contact No." required>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Contact No.</label>
                                                                <input class="form-control" name="emp_contact" placeholder="Contact No." required>
                                                            </div>
                                                        </div> -->
                                                        
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Date Hired</label>
                                                                <input type="date" class="form-control" name="date_hired" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Employment Status</label>
                                                                <select class="form-control" name="emp_status" required>
                                                                    <option value="" disabled selected=1>SELECT</option>
                                                                    <option value="Regular">Regular</option>
                                                                    <!-- <option value="Probationary">Probationary</option> -->
                                                                    <option value="Casual">Casual</option>
                                                                    <option value="Probationary">Probationary</option>
                                                                    <option value="Trainee">Trainee</option>
                                                                    <!-- <option value="Part-time">Part-time</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Gross monthly income</label>
                                                                <input type="number" name="gross" class="form-control" placeholder="Gross monthly income" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Mode of Salary</label>
                                                                <select class="form-control" name="mos" required>
                                                                    <option value="" disabled selected=1>SELECT</option>
                                                                    <option value="Cash">Cash</option>
                                                                    <option value="ATM">ATM</option>
                                                                    <option value="Check">Check</option>
                                                                    <!-- <option value="Self-employed">Self-employed</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Bank Name</label>
                                                                <input name="bank" class="form-control" placeholder="Bank Name" >
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Type of ATM Card</label>
                                                                <input name="toa" class="form-control" placeholder="Type of ATM Card" >
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Do you have other loan?</label>
                                                                <input name="radio" class="form-control" placeholder="Bank Name" >
                                                            </div>
                                                        </div> -->
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Salary Period</label>
                                                                <select class="form-control" name="sal_period" required>
                                                                    <option value="" disabled selected=1>SELECT</option>
                                                                    <option value="5/20">5/20</option>
                                                                    <option value="6/21">6/21</option>
                                                                    <option value="7/22">7/22</option>
                                                                    <option value="8/23">8/23</option>
                                                                    <option value="10/25">10/25</option>
                                                                    <option value="15/30">15/30</option>
                                                                    <option value="Weekly (every Friday)">Weekly (every Friday)</option>
                                                                    <option value="Every 2nd Saturday">Every 2nd Saturday</option>
                                                                    <!-- <option value="Self-employed">Self-employed</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                        <label><b>Do you have other loan?</b></label>
                                                            <div class="form-group">
                                                                <div class="radio">
                                                                
                                                                <label>
                                                                    <input type="radio" name="oloan" id="rlw_parents" value="0" onclick="enableField()">None &nbsp;
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="oloan" id="rlw_others" value="Others" onclick="enableField()">Yes (specify):
                                                                </label>
                                                                <input type="number" name="oloan" id="rlw_spec" class="form-group" disabled="true">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Other Source of Income</label>
                                                                <input name="osource" class="form-control" placeholder="Other Source of Income" >
                                                            </div>
                                                        </div>                    
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Other income (monthly)</label>
                                                                <input type="number" name="other_income" class="form-control" placeholder="Other income (monthly)" required>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Supervisor / Coordinator</label>
                                                                <input name="supervisor" class="form-control" placeholder="Supervisor / Coordinator" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Supervisor / Coordinator Contact No.</label>
                                                                <input name="supervisor_contact" class="form-control" placeholder="Supervisor / Coordinator Contact No." required>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-lg-12" align="right">
                                                            <button type="submit" class="btn btn-primary" name="submit">
                                                                <i class="fa fa-fw" aria-hidden="true" title="Copy to use save">&#xf0c7</i> Save
                                                            </button>
                                                            <!-- <button type="reset" class="btn btn-warning">Reset Button</button> -->
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.row (nested) -->
                                            </div>
                                            <!-- /.panel-body -->
                                        </div>
                                        <!-- /.panel -->

                                        </div>
                                        
                                        <!-- <div class="tab-pane fade" id="tab-default-3">Page 3</div>
                                        <div class="tab-pane fade" id="tab-default-4">Page 4</div>
                                        <div class="tab-pane fade" id="tab-default-5">Page 5</div> -->
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
            function showSpouse(val){
                // var x = document.getElementById("div_spouse").value;
                if(val == "Married"){
                    // alert("hello");
                    document.getElementById('div_spouse').style.display = "block";
                }else{
                    document.getElementById('div_spouse').style.display = "none";
                }
            }

            var dep = 0;
            function addDependent(){
                dep++;
                var objTo = document.getElementById('div_dep');
                var divtest = document.createElement("div");
                divtest.innerHTML = '<div id="'+dep+'"><div class="col-lg-3"><div class="form-group"><label>Name</label><input name="dep_name[]" class="form-control" placeholder="Name of dependent"></div></div><div class="col-lg-2"><div class="form-group"><label>Date of birth</label><input type="date" name="dep_dob[]" class="form-control" placeholder="Date of birth"></div></div><div class="col-lg-1"><button type="button" class="btn btn-danger btn-circle" onclick="removeDependent('+dep+')"><i class="fa fa-trash-o"></i></button></div></div>';
                objTo.appendChild(divtest);
            }

            function removeDependent(dval){
                dep--;
                // var element = document.getElementById(dval);
                // element.remove();
                // var element = dval;
                // element.parentNode.removeChild(dval);
                var element = document.getElementById(dval);
                element.remove();

                
            }

            // function enableField(){
            //     var others = document.getElementByID("rlw_others");
            //     var spec = document.getElementByID("rlw_spec");
            //     spec.disabled = others.checked ? false : true;
            //         if (!spec.disabled) {
            //             spec.focus();
            //         }
            // }
            function enableField() {
            var others = document.getElementById("rlw_others");
            var spec = document.getElementById("rlw_spec");
            var parent = document.getElementById("rlw_parent"); 
            if(others.checked == true){
                spec.disabled = false;
                spec.focus();
            }else{
                spec.disabled = true;
            }

            // function enableField2() {
            // var others2 = document.getElementById("rlw_others2");
            // var spec2 = document.getElementById("rlw_spec2");
            // var parent2 = document.getElementById("rlw_parent2"); 
            // if(others.checked == true){
            //     spec2.disabled = false;
            //     spec2.focus();
            // }else{
            //     spec2.disabled = true;
            // }
            // spec.disabled = others.checked ? false : true;
            // if (!spec.disabled) {
            //     spec.focus();
            // }
            
        }

            

        </script>

    </body>
</html>
