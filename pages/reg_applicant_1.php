<?php
include('../config/conn.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
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
        <style>
            .div_box {
                /* border: 1px solid #aaa; */
                padding: 10px;
                display: block;
            }

            .checkbx:checked + .div_box {
                display: none;
            }
        </style>

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
                                        <h3>STEP 1: Personal Information</h3>
                                        <div class="panel panel-primary">
                                            <!-- <div class="panel-heading">
                                                Personal Information
                                            </div> -->
                                            <div class="panel-body">
                                                <div class="row">
                                                    <form role="form" action="reg_applicant_2.php" method="post">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input class="form-control" name="fname" placeholder="First Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Middle Name</label>
                                                                <input class="form-control" name="mname" placeholder="Middle Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input class="form-control" name="lname" placeholder="Last Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Suffix</label>
                                                                <input class="form-control" name="suffix" placeholder="Suffix">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Gender</label>
                                                                <select class="form-control" name="gender" required>
                                                                    <option value="" disabled selected=1>SELECT</option>
                                                                    <option value="M">Male</option>
                                                                    <option value="F">Female</option>
                                                                    <option value="O">Others</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Date of birth</label>
                                                                <input type="date" name="dob" class="form-control" placeholder="Date of birth" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Place of birth</label>
                                                                <input name="pob" class="form-control" placeholder="Place of birth" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Mobile No.</label>
                                                                <input name="mobile" class="form-control" placeholder="Mobile No." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <h4>PRESENT ADDRESS:</h4>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Block / Lot / Street / Phase / Zone</label>
                                                                <input name="blk" class="form-control" placeholder="Block / Lot / Street / Phase / Zone">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Barangay</label>
                                                                <!-- <select class="form-control" name="brgy" required>
                                                                    <option value="" disabled selected=1>SELECT</option>
                                                                    <option value="Alasas">Alasas</option>
                                                                    <option value="Baliti">Baliti</option>
                                                                    <option value="Bulaon">Bulaon</option>
                                                                    <option value="Calulut">Calulut</option>
                                                                    <option value="Dela Paz Norte">Dela Paz Norte</option>
                                                                    <option value="Dela Paz Sur">Dela Paz Sur</option>
                                                                    <option value="Del Carmen">Del Carmen</option>
                                                                    <option value="Del Pilar">Del Pilar</option>
                                                                    <option value="Del Rosario">Del Rosario</option>
                                                                    <option value="Dolores">Dolores</option>
                                                                    <option value="Juliana">Juliana</option>
                                                                    <option value="Lara">Lara</option>
                                                                    <option value="Lourdes">Lourdes</option>
                                                                    <option value="Maimpis">Maimpis</option>
                                                                    <option value="Magliman">Magliman</option>
                                                                    <option value="Malino">Malino</option>
                                                                    <option value="Malpitic">Malpitic</option>
                                                                    <option value="Pandaras">Pandaras</option>
                                                                    <option value="Panipuan">Panipuan</option>
                                                                    <option value="Pulung Bulo">Pulung Bulo</option>
                                                                    <option value="Santo Rosario (Poblacion)">Santo Rosario (Poblacion)</option>
                                                                    <option value="Quebiawan">Quebiawan</option>
                                                                    <option value="Saguin">Saguin</option>
                                                                    <option value="San Agustin">San Agustin</option>
                                                                    <option value="San Felipe">San Felipe</option>
                                                                    <option value="San Isidro">San Isidro</option>
                                                                    <option value="San Jose">San Jose</option>
                                                                    <option value="San Juan">San Juan</option>
                                                                    <option value="San Nicolas">San Nicolas</option>
                                                                    <option value="San Pedro Cutud">San Pedro Cutud</option>
                                                                    <option value="Santa Lucia">Santa Lucia</option>
                                                                    <option value="Santa Teresita">Santa Teresita</option>
                                                                    <option value="Santo Niño">Santo Niño</option>
                                                                    <option value="Sindalan">Sindalan</option>
                                                                    <option value="Telabastagan">Telabastagan</option>
                                                                </select> -->
                                                                <input name="brgy" class="form-control" placeholder="Barangay" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>City / Municipality</label>
                                                                <input name="city" class="form-control" placeholder="City/Municipality" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Province</label>
                                                                <input name="province" class="form-control" placeholder="Province" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Zip Code</label>
                                                                <input name="zip" class="form-control" maxlength="4" placeholder="Zipcode" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Google Map URL</label>&nbsp;
                                                                <a href="https://www.google.com/maps/@15.0667257,120.5786986,12z" target="_blank">
                                                                    <!-- <button class="btn-success"> -->
                                                                        <i class="fa fa-map" aria-hidden="true"></i> Open Google Map
                                                                    <!-- </button> -->
                                                                </a>
                                                                <input name="map" class="form-control" placeholder="Google Map URL" required>
                                                                 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Resident Status</label>
                                                                <select class="form-control" name="resident" required>
                                                                    <option value="" disabled selected=1>SELECT</option>
                                                                        <option value="Owned">Owned</option>
                                                                        <option value="Renting">Renting</option>
                                                                    </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Years of stay</label>
                                                                <input type="number" name="yrsstay" class="form-control" min="0" placeholder="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                        <label>Living With:</label>
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="rlw" id="rlw_parents" value="PARENTS" onclick="enableField()">PARENTS &nbsp;
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="rlw" id="rlw_relatives" value="RELATIVES" onclick="enableField()">RELATIVES &nbsp;
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="rlw" id="rlw_relatives" value="WIFE/HUSBAND/LIVE-IN PARTNER" onclick="enableField()">WIFE/HUSBAND/LIVE-IN PARTNER &nbsp;
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="rlw" id="rlw_relatives" value="CO-WORKER" onclick="enableField()">CO-WORKER &nbsp;
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="rlw" id="rlw_others" value="Others" onclick="enableField()">Others (specify):
                                                                        </label>
                                                                        <input type="text" name="rlw" id="rlw_spec" class="form-group" disabled="true">
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            
                                                                        </div>
                                                                        <div class="form-group">
                                                                            
                                                                        </div>  
                                                                    </div>
                                                            </div>
                                                        </div>

                                                        <!-- permanent address -->
                                                        
                                                        <div class="col-lg-12">
                                                                    <h4>PERMANENT ADDRESS:</h4>
                                                                    Use Present Address? &nbsp;<input type="checkbox" class="checkbx" name="perm" id="perm">
                                                            <div class="div_box">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Block / Lot / Street / Phase / Zone</label>
                                                                        <input name="blk2" id="blk2" class="form-control" placeholder="Block / Lot / Street / Phase / Zone">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Barangay</label>
                                                                        <!-- <select class="form-control" name="brgy2" id="brgy2">
                                                                            <option value="" disabled selected=1>SELECT</option>
                                                                            <option value="Alasas">Alasas</option>
                                                                            <option value="Baliti">Baliti</option>
                                                                            <option value="Bulaon">Bulaon</option>
                                                                            <option value="Calulut">Calulut</option>
                                                                            <option value="Dela Paz Norte">Dela Paz Norte</option>
                                                                            <option value="Dela Paz Sur">Dela Paz Sur</option>
                                                                            <option value="Del Carmen">Del Carmen</option>
                                                                            <option value="Del Pilar">Del Pilar</option>
                                                                            <option value="Del Rosario">Del Rosario</option>
                                                                            <option value="Dolores">Dolores</option>
                                                                            <option value="Juliana">Juliana</option>
                                                                            <option value="Lara">Lara</option>
                                                                            <option value="Lourdes">Lourdes</option>
                                                                            <option value="Maimpis">Maimpis</option>
                                                                            <option value="Magliman">Magliman</option>
                                                                            <option value="Malino">Malino</option>
                                                                            <option value="Malpitic">Malpitic</option>
                                                                            <option value="Pandaras">Pandaras</option>
                                                                            <option value="Panipuan">Panipuan</option>
                                                                            <option value="Pulung Bulo">Pulung Bulo</option>
                                                                            <option value="Santo Rosario (Poblacion)">Santo Rosario (Poblacion)</option>
                                                                            <option value="Quebiawan">Quebiawan</option>
                                                                            <option value="Saguin">Saguin</option>
                                                                            <option value="San Agustin">San Agustin</option>
                                                                            <option value="San Felipe">San Felipe</option>
                                                                            <option value="San Isidro">San Isidro</option>
                                                                            <option value="San Jose">San Jose</option>
                                                                            <option value="San Juan">San Juan</option>
                                                                            <option value="San Nicolas">San Nicolas</option>
                                                                            <option value="San Pedro Cutud">San Pedro Cutud</option>
                                                                            <option value="Santa Lucia">Santa Lucia</option>
                                                                            <option value="Santa Teresita">Santa Teresita</option>
                                                                            <option value="Santo Niño">Santo Niño</option>
                                                                            <option value="Sindalan">Sindalan</option>
                                                                            <option value="Telabastagan">Telabastagan</option>
                                                                        </select> -->
                                                                        <input name="brgy2" class="form-control" placeholder="Barangay">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>City / Municipality</label>
                                                                        <input name="city2" id="city2" class="form-control" placeholder="City/Municipality">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Province</label>
                                                                        <input name="province2" id="province2" class="form-control" placeholder="Province">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Zip Code</label>
                                                                        <input name="zip2" id="zip2" class="form-control" maxlength="4" placeholder="Zipcode">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Google Map URL</label>&nbsp;
                                                                        <a href="https://www.google.com/maps/@15.0667257,120.5786986,12z" target="_blank">
                                                                            <!-- <button class="btn-success"> -->
                                                                                <i class="fa fa-map" aria-hidden="true"></i> Open Google Map
                                                                            <!-- </button> -->
                                                                        </a>
                                                                        <input name="map2" id="map2" class="form-control" placeholder="Google Map URL">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Resident Status</label>
                                                                        <select class="form-control" name="resident2" id="resident2">
                                                                            <option value="" disabled selected=1>SELECT</option>
                                                                            <option value="Owned">Owned</option>
                                                                            <option value="Renting">Renting</option>
                                                                            <option value="Bed Space">Bed Space</option>
                                                                            <option value="Living with Friends or Relatives">Living with Friends or Relatives</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Years of stay</label>
                                                                        <input type="number" name="yrsstay2" id="yrsstay2" class="form-control" min="0" placeholder="0">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label>Living With:</label>
                                                                        <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="rlw2" id="rlw_parents" value="PARENTS" onclick="enableField()">PARENTS &nbsp;
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="rlw2" id="rlw_relatives" value="RELATIVES" onclick="enableField()">RELATIVES &nbsp;
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="rlw2" id="rlw_relatives" value="WIFE/HUSBAND/LIVE-IN PARTNER" onclick="enableField()">WIFE/HUSBAND/LIVE-IN PARTNER &nbsp;
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="rlw2" id="rlw_relatives" value="CO-WORKER" onclick="enableField()">CO-WORKER &nbsp;
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="rlw2" id="rlw_others" value="Others" onclick="enableField()">Others (specify):
                                                                        </label>
                                                                        <input type="text" name="rlw2" id="rlw_spec" class="form-group" disabled="true">
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            
                                                                        </div>
                                                                        <div class="form-group">
                                                                            
                                                                        </div>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>

                                                        <div class="col-lg-12" align="right">    
                                                            <button type="submit" class="btn btn-primary" name="submit">
                                                                <i class="fa fa-fw" aria-hidden="true" title="Copy to use save">&#xf0c7</i> Next
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
            // spec.disabled = others.checked ? false : true;
            // if (!spec.disabled) {
            //     spec.focus();
            // }
            
        }
        // function permAddress(){
           
            // if ( $(this).is(':checked') ) {
            //     $('#permanentAdd').show();
            // } else {
            //     $('#permanentAdd').hide();
            // }
        

            

        </script>

    </body>
</html>
