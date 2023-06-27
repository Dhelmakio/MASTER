<?php
include('../config/conn.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
$id;
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('location:main_client.php');
}
$accid;

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
                            <h1 class="page-header">View Applicant</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="panel tabbed-panel panel-default">
                                <!-- <div class="panel-body"> -->
                                    <!-- <div class="panel-group" id="accordion"> -->
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h4>
                                                    Personal Information
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    
                                                    <?php
                                                        $sql = "SELECT * FROM clients INNER JOIN client_info on clients.client_id=client_info.client_id LEFT JOIN employer on clients.client_id=employer.client_id LEFT JOIN char_references on clients.client_id=char_references.client_id where clients.client_id=".$id;
                                                        $res = mysqli_query($con,$sql);
                                                        if(mysqli_num_rows($res) > 0){
                                                            while($row = mysqli_fetch_assoc($res)) {
                                                                $accid = $row['account_id'];
                                                                ?>  
                                                                    <!-- <div class="col-lg-12" align="right"><a href="main_client_update.php?id=<?php echo $id;?>">
                                                                                <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                                    <i class="fa fa-pencil" aria-hidden="true"></i> 
                                                                                </button>
                                                                    </a></div> -->
                                                                    <div class="col-lg-12"><h4>PERSONAL INFORMATION</h4><br></div>
                                                                    <div class="col-lg-12"><label>Name: <u><?php echo $row['last_name'].", ".$row['first_name']." ".$row['middle_name'];?></h4></label></div>
                                                                    <div class="col-lg-12"><label>Address: <u><?php echo $row['street'].", ".$row['brgy'].", ".$row['city'].", ".$row['province'].", ".$row['zipcode'];?></label></div>
                                                                    <div class="col-lg-12"><label>Gender: <u><?php echo $row['gender']?></label></div>
                                                                    <div class="col-lg-12"><label>Date of Birth: <u><?php echo $row['dob']?></label></div>
                                                                    <div class="col-lg-12"><label>Place of Birth: <u><?php echo $row['pob']?></label></div>
                                                                    <div class="col-lg-12"><label>Contact No.: <u><?php echo $row['mobile']?></label></div>
                                                                    <div class="col-lg-12"><hr></div>
                                                                    <div class="col-lg-12"><h4>FAMILY BACKGROUND</h4><br></div>
                                                                    <div class="col-lg-12"><label>Mother's Name: <u><?php echo $row['mother_name']?></label></div>
                                                                    <div class="col-lg-12"><label>Mother's Contact No.: <u><?php echo $row['mother_contact']?></label></div>
                                                                    <div class="col-lg-12"><label>Father's Name: <u><?php echo $row['father_name']?></label></div>
                                                                    <div class="col-lg-12"><label>Father's Contact No.: <u><?php echo $row['father_contact']?></label></div>
                                                                    <div class="col-lg-12"><label>Living With: <u><?php echo $row['living_with']?></label></div>
                                                                    <div class="col-lg-12"><label>Marital Status: <u><?php echo $row['marital_status'];?></label></div>
                                                                    <div class="col-lg-12"><hr></div>
                                                                    <?php if($row['marital_status'] != "SINGLE"){?>
                                                                    <div class="col-lg-12"><h4>SPOUSE'S INFORMATION</h4><br></div>
                                                                    <div class="col-lg-12"><label>Name: <u><?php echo $row['spouse_name']?></label></div>
                                                                    <div class="col-lg-12"><label>Contact No.: <u><?php echo $row['spouse_contact']?></label></div>
                                                                    <div class="col-lg-12"><label>Date of Birth: <u><?php echo $row['spouse_dob']?></label></div>
                                                                    <div class="col-lg-12"><label>Place of Birth: <u><?php echo $row['spouse_pob']?></label></div>
                                                                    <div class="col-lg-12"><label>Address: <u><?php echo $row['spouse_address']?></label></div>
                                                                    <div class="col-lg-12"><label>Occupation: <u><?php echo $row['spouse_occupation'];?></label></div>
                                                                    <div class="col-lg-12"><label>Employer: <u><?php echo $row['spouse_employer'];?></label></div>
                                                                    <div class="col-lg-12"><hr></div>
                                                                    <?php }?>
                                                                    <div class="col-lg-12"><h4>DEPENDENTS</h4><br></div>
                                                                    <?php 
                                                                    $sql = "SELECT * FROM dependents where dependents.client_id=".$id;
                                                                    $res = mysqli_query($con,$sql);
                                                                    if(mysqli_num_rows($res) > 0){
                                                                        while($row = mysqli_fetch_assoc($res)) {
                                                                            ?>
                                                                                <div class="col-lg-12"><label>Name: <u><?php echo $row['name']?></label></div>
                                                                            <?php
                                                                        }
                                                                        }else{
                                                                            ?>
                                                                                <div class="col-lg-12"><label>NONE</label></div>
                                                                            <?php
                                                                        }
                                                                    ?>   
                                                                    
                                                                    
                                                                <?php
                                                            }
                                                        }

                                                        

                                                        
                                                        
                                                    ?>
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                    <!-- </div> -->
                                    <!-- /.row (nested) -->
                                <!-- </div> -->
                                <!-- /.panel-body -->

                                

                                <!-- </div> -->
                            
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.div -->
                        <div class="col-lg-6">
                            <div class="panel tabbed-panel panel-default">
                                <!-- <div class="panel-body"> -->
                                    <!-- <div class="panel-group" id="accordion"> -->
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h4>
                                                    Employment Information
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    
                                                    <?php
                                                        $sql = "SELECT * FROM clients INNER JOIN client_info on clients.client_id=client_info.client_id LEFT JOIN employer on clients.client_id=employer.client_id where clients.client_id=".$id;
                                                        $res = mysqli_query($con,$sql);
                                                        if(mysqli_num_rows($res) > 0){
                                                            while($row = mysqli_fetch_assoc($res)) {
                                                                ?>  
                                                                    <!-- <div class="col-lg-12" align="right">
                                                                        <a href="reg_applicant_employment.php?id=<?php echo $id;?>">
                                                                                <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                                    <i class="fa fa-pencil" aria-hidden="true"></i> 
                                                                                </button>
                                                                        </a>
                                                                    </div> -->
                                                                    
                                                                    <?php if($row['employer_name'] != ""){?>
                                                                    <div class="col-lg-12"><h4>EMPLOYMENT INFORMATION</h4></div>
                                                                    <div class="col-lg-12"><h5><u>EMPLOYER PROFILE</u></h5></div>
                                                                    <div class="col-lg-12"><label>Employer / Agency Name: <u><?php echo $row['employer_name']?></label></div>
                                                                    <div class="col-lg-12"><label>Employer Type: <u><?php echo $row['employer_type']?></label></div>
                                                                    <div class="col-lg-12"><label>Nature of Business: <u><?php echo $row['nature_of_business'];?></label></div>
                                                                    <div class="col-lg-12"><label>Address: <u><?php echo $row['address']?></label></div>
                                                                    <div class="col-lg-12"><label>HR Personnel: <u><?php echo $row['hr_personnel'];?></label></div>
                                                                    <div class="col-lg-12"><label>HR Personnel Contact No.: <u><?php echo $row['hr_contact'];?></label></div>
                                                                    <div class="col-lg-12"><h5><u>EMPLOYEE PROFILE</u></h5></div>
                                                                    <div class="col-lg-12"><label>Date Hired: <u><?php echo $row['date_hired']?></label></div>
                                                                    <div class="col-lg-12"><label>Employment Status: <u><?php echo $row['employment_status']?></label></div>
                                                                    <div class="col-lg-12"><label>Work Position: <u><?php echo $row['position']?></label></div>
                                                                    <div class="col-lg-12"><label>Mode of Salary: <u><?php echo $row['mode_of_salary']?></label></div>
                                                                    <div class="col-lg-12"><label>Bank: <u><?php echo $row['bank']?></label></div>
                                                                    <div class="col-lg-12"><label>Type of ATM: <u><?php echo $row['type_of_atm']?></label></div>
                                                                    <div class="col-lg-12"><label>Salary Period: <u><?php echo $row['salary_period']?></label></div>
                                                                    <div class="col-lg-12"><label>Other Source of Income: <u><?php echo $row['other_source']?></label></div>
                                                                    <div class="col-lg-12"><label>₱ <u><?php echo $row['gross_monthly'];?>.00 (Gross Monthly Income)</label></div>
                                                                    <div class="col-lg-12"><label>₱ <u><?php echo $row['other_income'];?>.00 (Other Monthly Income )</label></div>
                                                                    <div class="col-lg-12"><label>₱ <u><?php echo $row['other_loan']?>.00 (Other Loan)</label></div>
                                                                    <div class="col-lg-12"><label style="color:blue">₱ <u><?php 
                                                                    $net = ($row['other_income'] + $row['gross_monthly']) - $row['other_loan'];
                                                                    echo $net;
                                                                    ?>.00 (Net Monthly Income )</label></div>
                                                                    <div class="col-lg-12"><hr></div>
                                                                    <div class="col-lg-12"><label><a href="../assets/docs/<?php echo $accid?>/<?php echo $accid?>.pdf" target="_blank">View Documents</a></label></div>
                                                                    <?php }
                                                                    // else{ echo "No employer info";}
                                                                    ?>
                                                                <?php
                                                            }
                                                        }

                                                        

                                                        
                                                        
                                                    ?>
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                    <!-- </div> -->
                                    <!-- /.row (nested) -->
                                <!-- </div> -->
                                <!-- /.panel-body -->

                                

                                <!-- </div> -->
                            
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.div -->
                        
                        
                                        
                                        <!-- <div class="tab-pane fade" id="tab-default-3">Page 3</div>
                                        <div class="tab-pane fade" id="tab-default-4">Page 4</div>
                                        <div class="tab-pane fade" id="tab-default-5">Page 5</div> -->
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
