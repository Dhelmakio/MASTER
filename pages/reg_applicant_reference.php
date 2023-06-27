<?php
include('../config/conn.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
$id;


if(isset($_POST['submit'])){
    $ceil;
    $branch_code = 'UA001';
    $check = "select client_id from clients order by client_id desc limit 1";
    $res_check = mysqli_query($con,$check);
    if(mysqli_num_rows($res_check) > 0){
        while($row_check = mysqli_fetch_assoc($res_check)) {
            $ceil = $row_check['client_id'];
        }
    }
    $ceil+=1;
    $account_id = $branch_code.sprintf("%09d", $ceil);
    echo "account id: ".$account_id;

    // GET POST DATA
    $fname = strtoupper($_POST['fname']);
    $mname = strtoupper($_POST['mname']);
    $lname = strtoupper($_POST['lname']);
    $suffix = strtoupper($_POST['suffix']);
    $gender = strtoupper($_POST['gender']);
    $dob = date('Y-m-d', strtotime($_POST['dob']));
    echo "DATE OF BIRTH: ".$dob;
    $pob = strtoupper($_POST['pob']);
    $mobile = $_POST['mobile'];
    $str = strtoupper($_POST['blk']);
    $brgy = strtoupper($_POST['brgy']);
    $city = strtoupper($_POST['city']);
    $province = strtoupper($_POST['province']);
    $zip = $_POST['zip'];
    $map = $_POST['map'];
    $rest = strtoupper($_POST['resident']);
    $yrss = $_POST['yrsstay'];
    $str2 = strtoupper($_POST['blk']);
    $brgy2 = strtoupper($_POST['brgy']);
    $city2 = strtoupper($_POST['city']);
    $province2 = strtoupper($_POST['province']);
    $zip2 = $_POST['zip'];
    $map2 = $_POST['map'];
    $rest2 = strtoupper($_POST['resident']);
    $yrss2 = $_POST['yrsstay'];
    if(!isset($_POST['perm'])){
        $str2 = strtoupper($_POST['blk2']);
        $brgy2 = strtoupper($_POST['brgy2']);
        $city2 = strtoupper($_POST['city2']);
        $province2 = strtoupper($_POST['province2']);
        $zip2 = $_POST['zip2'];
        $map2 = $_POST['map2'];
        $rest2 = strtoupper($_POST['resident2']);
        $yrss2 = $_POST['yrsstay2'];
    }
    $exist = "SELECT * from clients where first_name='$fname' && last_name='$lname' && suffix='$suffix'";
    $res = mysqli_query($con,$exist);
    if(mysqli_num_rows($res) > 0){
        header('location:reg_failed.php');
    }else{
        // SQL INSERT STATEMENT
        $sql = "INSERT INTO clients (account_id,first_name,middle_name,last_name,suffix,gender,dob,pob,mobile,street,brgy,city,province,zipcode,res_status,yrs_res,perm_street,perm_brgy,perm_city,perm_province,perm_zip,perm_res_status,perm_yrs_res)VALUES('$account_id','$fname','$mname','$lname','$suffix','$gender','$dob','$pob','$mobile','$str','$brgy','$city','$province','$zip','$rest','$yrss','$str2','$brgy2','$city2','$province2','$zip2','$rest2','$yrss2')";
        if(mysqli_query($con, $sql)){
            $id = mysqli_insert_id($con);
            $_SESSION['id'] = $id;
            $alog_id = $_SESSION['user_id'];
            $alog_name = $_SESSION['name'];
            $act = "Added new client: ".$id;
            $log = "INSERT into activity_logs (user_id,name,activity) values ('$alog_id','$alog_name','$act')";
            mysqli_query($con,$log);
        }else{
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
    
    
}else{
    // header('location: main_client.php');
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
                                        <h3>STEP 5: Character References</h3>
                                        <div class="panel panel-primary">
                                            <!-- <div class="panel-heading">
                                                Personal Information
                                            </div> -->
                                            <div class="panel-body">
                                                <div class="row">
                                                    <form role="form" action="reg_applicant_4.php" method="post">
                                                        <!-- separator -->
                                                        <div class="col-lg-12"><hr></div>
                                                        
                                                        <!-- <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Contact No. (Employer)</label>
                                                                <input name="spouse_employer_contact" class="form-control" placeholder="Contact No. (Employer)">
                                                            </div>
                                                        </div> -->
                                                        <!-- separator -->
                                                        </div>
                                                        <div class="col-lg-12" align="right">
                                                            <button type="button" class="btn btn-success" onclick="addDependent()">
                                                                <i class="fa fa-fw" aria-hidden="true" title="Copy to use user-plus">&#xf234</i> Add Reference
                                                            </button></br></br>
                                                        </div>
                                                        <div id="div_dep">
                                                            <div id="dep">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" name="char_name[]" class="form-control" placeholder="Name of Relative or Co-worker" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Contact #</label>
                                                                        <input type="text" name="char_contact[]" class="form-control" placeholder="E.g. 09101234567" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Relationship</label>
                                                                        <input type="text" name="char_rel[]" class="form-control" placeholder="Relationship" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label>Time Available</label>
                                                                        <input type="text" name="char_time[]" class="form-control" placeholder="Time Available" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-1">
                                                                    <button type="button" class="btn btn-danger btn-circle" onclick="removeDependent('dep')"><i class="fa fa-trash-o"></i></button>
                                                                </div>
                                                            </div>
                                                            <div id="dep">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" name="char_name[]" class="form-control" placeholder="Name of Relative or Co-worker" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Contact #</label>
                                                                        <input type="text" name="char_contact[]" class="form-control" placeholder="E.g. 09101234567" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Relationship</label>
                                                                        <input type="text" name="char_rel[]" class="form-control" placeholder="Relationship" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label>Time Available</label>
                                                                        <input type="text" name="char_time[]" class="form-control" placeholder="Time Available" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-1">
                                                                    <button type="button" class="btn btn-danger btn-circle" onclick="removeDependent('dep')"><i class="fa fa-trash-o"></i></button>
                                                                </div>
                                                            </div>
                                                            <div id="dep">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" name="char_name[]" class="form-control" placeholder="Name of Relative or Co-worker" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Contact #</label>
                                                                        <input type="text" name="char_contact[]" class="form-control" placeholder="E.g. 09101234567" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Relationship</label>
                                                                        <input type="text" name="char_rel[]" class="form-control" placeholder="Relationship" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label>Time Available</label>
                                                                        <input type="text" name="char_time[]" class="form-control" placeholder="Time Available" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-1">
                                                                    <button type="button" class="btn btn-danger btn-circle" onclick="removeDependent('dep')"><i class="fa fa-trash-o"></i></button>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-lg-8">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input name="dep_name[]" class="form-control" placeholder="Name of dependent">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label>Date of birth</label>
                                                                    <input name="dep_dob[]" class="form-control" placeholder="Date of birth">
                                                                </div>
                                                            </div> -->
                                                        </div> 
                                                        <div class="col-lg-12">
                                                            <!-- <label><i>I hereby certify that the information provided in this form is complete, true and correct to the best of my knowledge.
I hold Una Amigo Lending Corporation free from liability from any law particularly the Data Privacy Act CRA 10173. I also confirm that Una Amigo Lending Corporation fully explained to me the contents of my loan application including its terms, rates and other important details in a language known and understood by me.    
        </i></label> -->
                                                        </div>
                                                        
                                                        
                                                            
                                                        <div class="col-lg-12" align="right">    
                                                            <button type="submit" name="submit" class="btn btn-primary">
                                                            <i class="fa fa-fw" aria-hidden="true" title="Copy to use save">&#xf0c7</i> Submit
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
                divtest.innerHTML = '<div id="'+dep+'"><div class="col-lg-3"><div class="form-group"><label>Name</label><input name="char_name[]" class="form-control" placeholder="Name of Relative or Co-worker"></div></div><div class="col-lg-3"><div class="form-group"><label>Contact #</label><input type="text" name="char_contact[]" class="form-control" placeholder="E.g. 09101234567"></div></div><div class="col-lg-3"><div class="form-group"><label>Relationship</label><input type="text" name="char_rel[]" class="form-control" placeholder="Relationship"></div></div><div class="col-lg-2"><div class="form-group"><label>Time Available</label><input type="text" name="char_time[]" class="form-control" placeholder="Time Available"></div></div><div class="col-lg-1"><button type="button" class="btn btn-danger btn-circle" onclick="removeDependent('+dep+')"><i class="fa fa-trash-o"></i></button></div></div>';
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
            // spec.disabled = others.checked ? false : true;
            // if (!spec.disabled) {
            //     spec.focus();
            // }
            
        }

            

        </script>

    </body>
</html>
