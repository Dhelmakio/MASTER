<?php
include('../config/conn.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
$id;
$accid;

if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "Select * from clients where client_id='$id'";
        $res_check = mysqli_query($con,$sql);
        if(mysqli_num_rows($res_check) > 0){
            while($row_check = mysqli_fetch_assoc($res_check)) {
                $accid = $row_check['account_id'];
            }
        }

}else{
    header('location: reg_applicant_index.php');
}

// if(isset($_POST['submit'])){

    
    
// }

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
                                        <h3>STEP 6: Document Upload</h3>
                                        <div class="panel panel-primary">
                                            <!-- <div class="panel-heading">
                                                Personal Information
                                            </div> -->
                                            <div class="panel-body">
                                                <div class="row">
                                                    <!-- <form role="form" action="#" method="post" > -->
                                                    <form method="post" action="reg_applicant_file_upload.php" rolw="form" enctype="multipart/form-data">
                                                        
                                                    <div class="col-lg-7">
                                                        <div class="form-group">
                                                        Select file to upload:
                                                            <input type="file" name="myfile" class="form-control" id="fileToUpload" accept="application/pdf" >
                                                            <input type="text" name="accid" value="<?php echo $accid;?>" hidden>
                                                            <input type="text" name="id" value="<?php echo $id;?>" hidden>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-7" align="right">    
                                                        <button type="submit" name="submit" class="btn btn-primary">
                                                            <i class="fa fa-fw" aria-hidden="true" title="Copy to use save">&#xf093</i> Upload
                                                        </button>
                                                            <!-- <button type="reset" class="btn btn-warning">Reset Button</button> -->
                                                    </div>

                                                    
                                                    
                                                        
                                                        
                                                        <!-- <div class="col-lg-6">
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
                                                        </div> -->
                                                        
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

            

        </script>

    </body>
</html>
