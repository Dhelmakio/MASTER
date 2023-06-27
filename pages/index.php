<?php
include('../config/conn.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
if($_SESSION['access'] == 3){
    header('location:reg_applicant_index.php');
}
if($_SESSION['access'] == 4){
    header('location:loan_credit_investigation.php');
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

        <title>LOAN MANAGEMENT SYSTEM - Dashboard</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../css/morris.css" rel="stylesheet">

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
                            <h1 class="page-header">Dashboard</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user-secret fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                                <?php
                                                    $for_ci = "SELECT Count(contract_no) as count from loan_applications where  ci_status=0 and approval=0";
                                                    $res_for_ci = mysqli_query($con,$for_ci);
                                                    if(mysqli_num_rows($res_for_ci) > 0){
                                                        while($row_for_ci = mysqli_fetch_assoc($res_for_ci)) {
                                                            echo $row_for_ci['count'];
                                                        }
                                                    }else{
                                                        echo "0";
                                                    }
                                                ?>
                                            </div>
                                            <div>For Credit Investigation</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-thumbs-o-up fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                                <?php
                                                    $for_ci = "SELECT Count(contract_no) as count from loan_applications where ci_status=0 || approval=0 and remarks !='reject'";
                                                    $res_for_ci = mysqli_query($con,$for_ci);
                                                    if(mysqli_num_rows($res_for_ci) > 0){
                                                        while($row_for_ci = mysqli_fetch_assoc($res_for_ci)) {
                                                            echo $row_for_ci['count'];
                                                        }
                                                    }else{
                                                        echo "0";
                                                    }
                                                ?>
                                            </div>
                                            <div>For Approval</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-check fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                            <?php
                                                    $now_d = date('Y-m-d');
                                                    $for_ci = "SELECT Count(contract_no) as count from loan_applications where approval=1 and remarks!='paid'";
                                                    $res_for_ci = mysqli_query($con,$for_ci);
                                                    if(mysqli_num_rows($res_for_ci) > 0){
                                                        while($row_for_ci = mysqli_fetch_assoc($res_for_ci)) {
                                                            echo $row_for_ci['count'];
                                                        }
                                                    }else{
                                                        echo "0";
                                                    }
                                                ?>
                                            </div>
                                            <div>Active Loans</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-warning fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                                <?php
                                                    $now_d = date('Y-m-d');
                                                    // echo $now_d;
                                                    $for_ci = "SELECT Count(payment_id) as count from payments where `due_date`<='$now_d' and payment_date IS NULL";
                                                    $res_for_ci = mysqli_query($con,$for_ci);
                                                    if(mysqli_num_rows($res_for_ci) > 0){
                                                        while($row_for_ci = mysqli_fetch_assoc($res_for_ci)) {
                                                            echo $row_for_ci['count'];
                                                        }
                                                    }else{
                                                        echo "0";
                                                    }
                                                ?>
                                            </div>
                                            <div>Due Payments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-list fa-fw"></i> Loan Status
                                    
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <!-- <th>#</th> -->
                                                    <th>CONTRACT NO.</th>
                                                    <th>LOAN AMOUNT</th>
                                                    <th>APPLICATION DATE</th>
                                                    <th>CI</th>
                                                    <th>APPROVED</th>
                                                    <!-- <th>REJECTED</th> -->
                                                    <th>ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql ="SELECT * FROM loan_applications where paid=0 and ci_status!=1  ORDER BY date_flagged ASC";
                                                    $res = mysqli_query($con,$sql);
                                                        if(mysqli_num_rows($res) > 0){
                                                            while($row = mysqli_fetch_assoc($res)) {
                                                                // $name = $row['last_name'].', '.$row['first_name'].' '.$row['middle_name'];
                                                                // $suffix = $row['suffix'];
                                                                // $cid = $row['client_id'];
                                                                // $name = $row['last_name'].', '.$row['first_name'].' '.$row['suffix'].' '.$row['middle_name'].' '.$row['suffix'];
                                                                ?><tr class="odd gradeX">
                                                                    <!-- <td><?php echo $row['last_name'].', '.$row['first_name'].' '.$row['suffix'].' '.$row['middle_name'];?></td> -->
                                                                    <td><?php echo $row['contract_no'];?></td>
                                                                    <td><?php echo $row['loan_amount'];?></td>
                                                                    <td><?php echo $row['application_date'];?></td>
                                                                    <td><?php 
                                                                    if($row['ci_status']==1){
                                                                        echo '<button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button>';}
                                                                    else if($row['ci_status']==2){
                                                                        echo '<button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>';
                                                                    }else{
                                                                        echo '<button type="button" class="btn btn-warning btn-circle"><i class="fa fa-spinner"></i></button>';
                                                                    }
                                                                    ?></td>
                                                                    <td><?php 
                                                                    if($row['approval']==1 && $row['ci_status'] != 2){
                                                                        echo '<button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button>';}
                                                                    else if($row['approval']==2 || $row['ci_status'] == 2){
                                                                        echo '<button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>';
                                                                    }else{
                                                                        echo '<button type="button" class="btn btn-warning btn-circle"><i class="fa fa-spinner"></i></button>';
                                                                    }
                                                                    ?></td>
                                                                    
                                                                    <td style="text-align:center">
                                                                        <?php echo '<a href="view_loan.php?cn='.$row['contract_no'].'" class="btn btn-primary btn-circle"><i class="fa fa-search"></i></button>'; ?>
                                                                    </td>
                                                                </tr><?php
                                                            }
                                                        }
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                            
                            <!-- /.panel -->
                            
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-8 -->
                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-check fa-fw"></i> Recently Approved Loans
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="list-group">
                                        <?php
                                                $recent_approved = "SELECT * FROM loan_applications where approval=1 order by date_flagged desc LIMIT 10";
                                                $res_app = mysqli_query($con,$recent_approved);
                                                if(mysqli_num_rows($res_app) > 0){
                                                    while($row_approved = mysqli_fetch_assoc($res_app)) {
                                                        // echo $row_approved['count'];
                                                        $dapp = strtotime($row_approved['date_flagged']);
                                                        $myFormatForView = date("M d, Y - H:i:s", $dapp);
                                                        ?>
                                                            <a href="#" class="list-group-item">
                                                                <i class="fa fa-check fa-fw"></i> <?php echo $row_approved['contract_no'];?>
                                                                    <span class="pull-right text-muted small"><em><?php echo $myFormatForView;?></em>
                                                                    </span>
                                                            </a>
                                                        <?php
                                                    }
                                                }else{
                                                    // echo "0";
                                                    echo "<em></em>";
                                                }
                                            ?>
                                        
                                        
                                    </div>
                                    <!-- /.list-group -->
                                    <!-- <a href="#" class="btn btn-default btn-block">View All Alerts</a> -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-times fa-fw"></i> Recently Rejected Loans
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="list-group">
                                        <?php
                                                $recent_reject = "SELECT * FROM loan_applications where approval=2 OR ci_status=2 order by date_flagged desc LIMIT 10";
                                                $res_rej = mysqli_query($con,$recent_reject);
                                                if(mysqli_num_rows($res_rej) > 0){
                                                    while($row_reject = mysqli_fetch_assoc($res_rej)) {
                                                        // echo $row_approved['count'];
                                                        $drej = strtotime($row_reject['date_flagged']);
                                                        $myFormatForViewRej = date("M d, Y - H:i:s", $drej);
                                                        ?>
                                                            <a href="#" class="list-group-item">
                                                                <i class="fa fa-times fa-fw"></i> <?php echo $row_reject['contract_no'];?>
                                                                    <span class="pull-right text-muted small"><em><?php echo $myFormatForViewRej;?></em>
                                                                    </span>
                                                            </a>
                                                        <?php
                                                    }
                                                }else{
                                                    echo "<em></em>";
                                                }
                                            ?>
                                        
                                        
                                    </div>
                                    <!-- /.list-group -->
                                    <!-- <a href="#" class="btn btn-default btn-block">View All Alerts</a> -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                            
                            <!-- /.panel -->
                            
                            <!-- /.panel .chat-panel -->
                        </div>
                        <!-- /.col-lg-4 -->
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

        <!-- Morris Charts JavaScript -->
        <script src="../js/raphael.min.js"></script>
        <!-- <script src="../js/morris.min.js"></script>
        <script src="../js/morris-data.js"></script> -->

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

        <script>
            function calculate(){
                // var x = document.getElementById("div_spouse").value;
                var x = document.getElementById("lamt").value;
                var y = document.getElementById("months").value;
                var interest = document.getElementById("interest").value;;
                var mint = (interest/y)*.10;
                var mo_am = x / y;
                var mo_amt = mo_am * mint;
                var final_amt = mo_amt+mo_am;
                document.getElementById('lamt').disabled = true;
                document.getElementById('months').disabled = true;
                document.getElementById('lamt_').value = x;
                document.getElementById('months_').value = y;

                

                if(x != "" && y != ""){
                    // alert(mo_amt);
                    document.getElementById('calculation').style.display = "block";
                    document.getElementById('mamt').value = final_amt;
                    document.getElementById('minterest').value = mint;
                    document.getElementById('mamort').value = final_amt;
                }else{
                    alert("Please fill required fields.");
                }
                    
                }
        </script>

    </body>
</html>
