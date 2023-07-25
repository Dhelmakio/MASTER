<?php
include('../config/conn.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
$contract_no;
$cid;
$ltype;
$duration;
$amt;
$interest;
$monthly;
$now = date('Y-m-d');
if(isset($_GET['con'])){
    $contract_no = $_GET['con'];
    $get_con = "SELECT * from loan_applications where contract_no='$contract_no'";
    $res = mysqli_query($con,$get_con);
    if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)) {
    $cid = $row['client_id'];
    $ltype = $row['loan_type'];
    $duration = $row['loan_duration'];
    $amt = $row['loan_amount'];
    $monthly = $row['monthly_amortization'];
    $interest = $row['interest_percentage'];
    }
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

    <title>Lending System - Preview</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

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
                        <h1 class="page-header">Loan Application Approval</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">

                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>INTEREST (%)</th>
                                                <th>PRINCIPAL</th>
                                                <th>DUE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                    for($x = 1; $x <= $duration; $x++){
                                                        ?><tr>
                                                <td><?php echo $x;?></td>
                                                <td style="text-align:right;">
                                                    <?php echo number_format(($interest/$duration),2);?></td>
                                                <td style="text-align:right;">₱ <?php echo number_format($monthly,2);?>
                                                </td>
                                                <td><?php echo "Every ".date('d')."th of the month";?></td>
                                            </tr><?php
                                                    }
                                                ?>
                                            <tr>
                                                <th>TOTAL</th>
                                                <th style="text-align:right;"><?php echo $interest;?></th>
                                                <th style="text-align:right;">₱
                                                    <?php echo number_format($monthly*$duration,2);?></th>
                                                <th></th>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <!-- /.table-responsive -->

                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12" align="center">
                        <button type="button" class="btn btn-danger btn-sml" data-toggle="modal"
                            data-target="#myModal_<?php echo $cid?>">
                            <i class="fa fa-times" aria-hidden="true" title="Copy to use save"></i> Reject
                        </button>
                        <a href="loan_approval_approve.php?con=<?php echo $contract_no;?>">
                            <button type="button" class="btn btn-primary btn-sml">
                                <i class="fa fa-check" aria-hidden="true" title="Copy to use save"></i> Approve
                            </button>
                        </a>
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="myModal_<?php echo $cid?>" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true" align="left">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Reason for rejection</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form action="loan_approval_reject.php" method="POST">
                                                <div class="col-lg-12">
                                                    <!-- <label>Reason for rejection:</label> -->
                                                    <input type="text" class="form-control" name="reason" value=""
                                                        placeholder="Enter reason" required>
                                                    <input type="text" name="con" value="<?php echo $contract_no;?>"
                                                        hidden><br>
                                                </div>
                                                <div class="col-lg-12" align="right">
                                                    <button type="submit" class="btn btn-primary" name="submit">
                                                        Confirm <i class="fa fa-check" aria-hidden="true"
                                                            title="Copy to use save"></i>
                                                    </button>
                                                </div>
                                            </form>
                                            <div class="col-lg-6">

                                            </div>
                                        </div>
                                    </div>
                                    <!-- <a href="loan_application_1.php?id=<?php echo $cid;?>">
                                                                                                    <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Apply">
                                                                                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i> 
                                                                                                    </button>
                                                                                                </a> -->
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- <a href="loan_approval_reject.php?con=<?php echo $contract_no;?>">
                                <button type="button" class="btn btn-danger btn-sml">
                                    Reject <i class="fa fa-times" aria-hidden="true" title="Copy to use save"></i>
                                </button>
                            </a> -->
                    </div>
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

    <!-- DataTables JavaScript -->
    <script src="../js/dataTables/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/startmin.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    </script>

</body>

</html>