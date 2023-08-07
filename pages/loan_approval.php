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

    <title>LOAN MANAGEMENT SYSTEM - Loan Approval</title>

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
                                    <table class="table table-striped table-bordered table-hover"
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>CONTRACT NO.</th>
                                                <th>NAME</th>
                                                <th>LOAN DETAILS</th>
                                                <th class="text-center">CI REMARKS</th>
                                                <th class="text-center">LOAN REMARKS</th>
                                                <th class="text-center">ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                    $sql ="SELECT * FROM loan_applications 
                                                    INNER JOIN applicants_personal 
                                                    ON applicants_personal.applicant_code = loan_applications.client_id 
                                                    WHERE approval=0 AND ci_status != 0 ORDER BY applicants_personal.lastname ASC";
                                                    $res = mysqli_query($con,$sql);
                                                        if(mysqli_num_rows($res) > 0){
                                                            while($row = mysqli_fetch_assoc($res)) {
                                                                // $name = $row['last_name'].', '.$row['first_name'].' '.$row['middle_name'];
                                                                // $suffix = $row['suffix'];
                                                                $cid = $row['client_id'];
                                                                $name = $row['lastname'].', '.$row['firstname'].' '.$row['suffix'].' '.$row['middlename'].' '.$row['suffix'];
                                                                $cis;
                                                                ?><tr class="odd gradeX">
                                                <td><?php echo $row['contract_no'];?></td>
                                                <td><?php echo $row['lastname'].', '.$row['firstname'].' '.$row['suffix'].' '.$row['middlename'];?>
                                                </td>
                                                <td class="text-center">₱
                                                    <?php echo number_format($row['loan_amount'],2);?></td>
                                                <td style="text-align:center">
                                                    <?php 
                                                    if($row['ci_status']==1){
                                                        $cis = 1;
                                                            echo '<button type="button" class="btn btn-primary btn-circle"><i class="fa fa-check"></i></button>';}
                                                        else{
                                                        $cis = 0;
                                                            echo '<button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>';
                                                        }
                                                    ?>
                                                </td>
                                                <td style="text-align:center">
                                                    <?php 
                                                    if($row['remarks']== "approved"){
                                                        echo '<button type="button" class="btn btn-primary"> Approved</button>';
                                                    }else if($row['remarks']== "decline"){
                                                        echo '<button type="button" class="btn btn-danger"> Declined</button>';
                                                    }else if($row['remarks']== "hold"){
                                                        echo '<button type="button" class="btn btn-warning"> On Hold</button>';
                                                    }else{
                                                        echo '<span class="btn btn-default"> None </span>';
                                                    }                                    
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-warning btn-sml"
                                                        data-target="#hold-<?= $row['contract_no'] ?>"
                                                        data-toggle="modal">
                                                        Hold <i class="fa fa-pause" aria-hidden="true"
                                                            title="Copy to use save"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sml"
                                                        data-target="#decline-<?= $row['contract_no'] ?>"
                                                        data-toggle="modal">
                                                        Decline <i class="fa fa-times" aria-hidden="true"
                                                            title="Copy to use save"></i></button>
                                                    <button type="button" class="btn btn-primary btn-sml"
                                                        data-target="#approve-<?= $row['contract_no'] ?>"
                                                        data-toggle="modal">
                                                        Approve <i class="fa fa-thumbs-up" aria-hidden="true"
                                                            title="Copy to use save"></i></button>
                                                    <!--Modals-->
                                                    <div class="modal fade text-left"
                                                        id="approve-<?=$row['contract_no'] ?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                                        data-backdrop="static">
                                                        <div class="modal-dialog modal-md" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <p>
                                                                        <center><i class="fa fa-thumbs-up fa-5x"
                                                                                style="color:#428bca;"
                                                                                aria-hidden="true"
                                                                                title="Copy to use archive"></i>
                                                                        </center>
                                                                        <center>
                                                                            <h5>Approve?</h5>
                                                                        </center>
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer" style="padding: 5px;">
                                                                    <form action="../request/reg_remarks.php"
                                                                        method="post">
                                                                        <button type="button"
                                                                            class="btn btn-default text-small"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <input type="hidden" name="id"
                                                                            value="<?=$row['contract_no'] ?>">
                                                                        <button type="submit" name="approve"
                                                                            class="btn btn-primary btn-sml">
                                                                            Confirm </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                    </div>
                                                    <div class="modal fade text-left"
                                                        id="decline-<?=$row['contract_no'] ?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                                        data-backdrop="static">
                                                        <div class="modal-dialog modal-md" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <p>
                                                                        <center><i class="fa fa-times fa-5x"
                                                                                style="color:#FF0000;"
                                                                                aria-hidden="true"
                                                                                title="Copy to use archive"></i>
                                                                        </center>
                                                                        <center>
                                                                            <h5>Decline?</h5>
                                                                        </center>
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer" style="padding: 5px;">
                                                                    <form action="../request/reg_remarks.php"
                                                                        method="post">
                                                                        <button type="button"
                                                                            class="btn btn-default text-small"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <input type="hidden" name="id"
                                                                            value="<?=$row['contract_no'] ?>">
                                                                        <button type="submit" name="decline"
                                                                            class="btn btn-primary text-small">Confirm</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                    </div>
                                                    <div class="modal fade text-left"
                                                        id="hold-<?=$row['contract_no'] ?>" tabindex="-1" role="dialog"
                                                        aria-labelledby="myModalLabel" aria-hidden="true"
                                                        data-backdrop="static">
                                                        <div class="modal-dialog modal-md" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <p>
                                                                        <center><i class="fa fa-pause fa-5x"
                                                                                style="color:#FFA500;"
                                                                                aria-hidden="true"
                                                                                title="Copy to use archive"></i>
                                                                        </center>
                                                                        <center>
                                                                            <h5>Hold?</h5>
                                                                        </center>
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer" style="padding: 5px;">
                                                                    <form action="../request/reg_remarks.php"
                                                                        method="post">
                                                                        <button type="button"
                                                                            class="btn btn-default text-small"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <input type="hidden" name="id"
                                                                            value="<?=$row['contract_no'] ?>">
                                                                        <button type="submit" name="hold"
                                                                            class="btn btn-primary text-small">Confirm</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                    </div>
                                                    <?php                                             
                                                        // echo'<a href="loan_approval_preview.php?con='.$row['contract_no'].'">
                                                        //     <button type="button" class="btn btn-success btn-sml">
                                                        //     Approve <i class="fa fa-thumbs-up" aria-hidden="true" title="Copy to use save"></i></button>
                                                        // </a>';
                                                ?>
                                                </td>
                                            </tr><?php
                                                            }
                                                        }
                                                ?>

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