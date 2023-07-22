<?php
session_start();

include('../config/conn.php');
require "../controller/reg_app.php";
// session_start();
// if(!isset($_SESSION['user_id'])){
//     header('location:login.php');
// }
$id;
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('location:reg_applicantion.php');
}

if($_SESSION['user_id']){
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
                                           $view = new Registry();
                                           $result = $view->displayData($id);
                                            foreach($result as $key => $row){
                                        ?>
                                        <div class="col-lg-12">
                                            <p class="lead">PERSONAL INFORMATION</p><br>
                                        </div>
                                        <div class="col-lg-12"><label>Name:
                                                <u><?php echo $row['lastname'].", ".$row['firstname']." ".$row['middlename']." ".$row['suffix'];?>
                                                    </h4></label></div>
                                        <div class="col-lg-12"><label>Address:
                                                <u><?php echo $row['street1'].", ".$row['brgy1'].", ".$row['city1'].", ".$row['province1'].", ".$row['phase1'];?></label>
                                        </div>
                                        <div class="col-lg-12"><label>Gender: <u><?php echo strtoupper($row['gender'])?></label>
                                        </div>
                                        <div class="col-lg-12"><label>Date of Birth:
                                                <u><?php echo date('F d, Y',strtotime($row['dob1'])) ?></label></div>
                                        <div class="col-lg-12"><label>Place of Birth:
                                                <u><?php echo $row['pob1']?></label></div>
                                                <div class="col-lg-12"><label>Marital Status:
                                                <u><?php echo strtoupper($row['mstatus'])?></label></div>
                                        <div class="col-lg-12"><label>Contact No.:
                                                <u><?php echo $row['contact1']?></label></div>
                                              
                                        <div class="col-lg-12">
                                            <hr>
                                        </div>
                                        <div class="col-lg-12">
                                            <p class="lead">FAMILY BACKGROUND</p><br>
                                        </div>
                                        <div class="col-lg-12"><label>Mother's Name:
                                                <u><?php echo $row['mothername']?></label></div>
                                        <div class="col-lg-12"><label>Mother's Contact No.:
                                                <u><?php echo $row['mothercon']?></label></div>
                                        <div class="col-lg-12"><label>Father's Name:
                                                <u><?php echo $row['fathername']?></label></div>
                                        <div class="col-lg-12"><label>Father's Contact No.:
                                                <u><?php echo $row['fathercon']?></label></div>
                                        <div class="col-lg-12"><label>Living With:
                                                <u><?php echo $row['lwith1']?></label></div>
                                        <div class="col-lg-12">
                                            <hr>
                                        </div>
                                        <?php 
                                            if($row['mstatus'] == "Married"){
                                        ?>
                                        <div class="col-lg-12">
                                            <p class="lead">SPOUSE'S INFORMATION</p><br>
                                        </div>
                                        <div class="col-lg-12"><label>Name: <u><?php echo $row['spouse_name']?></label>
                                        </div>
                                        <div class="col-lg-12"><label>Contact No.:
                                                <u><?php echo $row['contact']?></label></div>
                                        <div class="col-lg-12"><label>Date of Birth:
                                                <u><?php echo date('F d, Y',strtotime($row['s_dob']))?></label></div>
                                        <div class="col-lg-12"><label>Place of Birth:
                                                <u><?php echo $row['s_pob']?></label></div>
                                        <div class="col-lg-12"><label>Address: <u><?php echo $row['s_address']?></label>
                                        </div>
                                        <div class="col-lg-12"><label>Occupation:
                                                <u><?php echo $row['s_occupation'];?></label></div>
                                        <div class="col-lg-12">
                                            <hr>
                                        </div>
                                        <?php 
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.div -->
                    <?php if($row['employer'] != ""){?>
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

                                        <div class="col-lg-12">
                                            <p class="lead">EMPLOYMENT INFORMATION</p><br>
                                        </div>
                                        <div class="col-lg-12"><label>Employer / Agency Name:
                                                <u><?php echo $row['employer']?></label></div>
                                        <div class="col-lg-12"><label>Sector Type:
                                                <u><?php echo strtoupper($row['sector_type'])?></label></div>
                                        <div class="col-lg-12"><label>Type of Business:
                                                <u><?php echo strtoupper($row['tob'])?></label></div>
                                        <div class="col-lg-12"><label>Complete Address of Company:
                                                <u><?php echo $row['com_address']?></label></div>
                                        <div class="col-lg-12"><label>Assigned Location:
                                                <u><?php echo $row['a_location']?></label></div>
                                        <div class="col-lg-12"><label>Name of Supervisor/COOR/Supervisor:
                                                <u><?php echo $row['sup_name']?></label></div>
                                        <div class="col-lg-12"><label>Contact Number of HR/COOR/Supervisor:
                                                <u><?php echo $row['hr_number']?></label></div>
                                        <div class="col-lg-12"><label>Date Hired:
                                                <u><?php echo ($row['date_hired'] == "0000-00-00") ? $row['date_hired'] : date('F d, Y',strtotime($row['date_hired']));  ?>
                                        </div>
                                        <div class="col-lg-12"><label>Employment Status:
                                                <u><?php echo $row['e_status'];?></label></div>
                                        <div class="col-lg-12"><label>Mode of Salary:
                                                <u><?php echo $row['m_salary'];?></label></div>
                                        <div class="col-lg-12"><label>Bank Name:
                                                <u><?php echo $row['bank_name'];?></label></div>
                                        <div class="col-lg-12"><label>Type of ATM Card:
                                                <u><?php echo $row['atm_card'];?></label></div>
                                        <div class="col-lg-12"><label>Do you have other loan?
                                                <u><?php 
                                                $exploan =  explode("-", $row['loan']);
                                                if(count($exploan) > 1){
                                                    echo strtoupper($exploan[0]).' ('.$exploan[1].')';
                                                }else{
                                                    echo strtoupper($exploan[0]);
                                                }
                                                ?></label></div>
                                        <div class="col-lg-12"><label>Gross (Monthly):
                                                <u><?php  echo  "₱ ".number_format(floatval($row['monthly_salary']),2);?></label>
                                        </div>
                                        <div class="col-lg-12"><label>Salary Period:
                                                <u><?php echo $row['s_period'];?></label></div>
                                        <div class="col-lg-12"><label>Other Source of Income:
                                                <u><?php echo $row['other_source'];?></label></div>
                                        <div class="col-lg-12"><label>(Specify):
                                                <u><?php echo strtoupper($row['specify']);?></label></div>
                                        <div class="col-lg-12">
                                            <hr>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.div -->
                    <?php 
                            }
                        }                                                    
                    ?>
                </div>
                <br>
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
    function showSpouse(val) {
        // var x = document.getElementById("div_spouse").value;
        if (val == "Married") {
            // alert("hello");
            document.getElementById('div_spouse').style.display = "block";
        } else {
            document.getElementById('div_spouse').style.display = "none";
        }
    }
    </script>
</body>

</html>
<?php
}else{
    header('location: index.php');
}
?>