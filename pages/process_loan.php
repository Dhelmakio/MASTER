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

    <title>Lending System - Credit Investigation | Validation</title>

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
                        <h1 class="page-header">Process Loan</h1>
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
                                                <th style="text-align:center;">CONTRACT NO.</th>
                                                <th style="text-align:center;">NAME</th>
                                                <th style="text-align:center;">LOAN AMOUNT</th>
                                                <th style="text-align:center;">DATE OF APPLICATION</th>
                                                <th style="text-align:center;">DATE VALIDATED</th>
                                                <th style="text-align:center;">STATUS</th>
                                                <th style="text-align:center;">ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //LEFT or INNER?
                                                $sql ="SELECT * FROM loan_applications 
                                                INNER JOIN applicants_personal 
                                                ON applicants_personal.applicant_code = loan_applications.client_id WHERE loan_applications.ci_status != 0 
                                                ORDER BY applicants_personal.lastname ASC";
                                                $res = mysqli_query($con,$sql);
                                                    if(mysqli_num_rows($res) > 0){
                                                        while($row = mysqli_fetch_assoc($res)) {
                                                        // $name = $row['last_name'].', '.$row['first_name'].' '.$row['middle_name'];
                                                        // $suffix = $row['suffix'];
                                                        $cid = $row['applicant_code'];
                                                        $lid = $row['loan_id'];
                                                        $name = $row['lastname'].', '.$row['firstname'].' '.$row['suffix'].' '.$row['middlename'].' '.$row['suffix'];
                                                        $adate = $row['application_date'];
                                                        $process_status = $row['process_status'];
                                                        //$cis = $row['ci_status'];
                                                ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $row['contract_no'];?></td>
                                                <td><?php echo $row['lastname'].', '.$row['firstname'].' '.$row['suffix'].' '.$row['middlename'];?>
                                                </td>
                                                <td style="text-align:right;">₱
                                                    <?php echo number_format($row['loan_amount'],2);?></td>
                                                <td class="text-center"><?php echo date('F d, Y',strtotime($adate));?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <?php echo date('F d, Y',strtotime($row['ci_date']));?></td>
                                                <td style="text-align:center;">
                                                <?php
                                                echo ($process_status == 2) ? "<span class='btn btn-danger'> <i
                                                class='fa fa-check'></i> Re-validated</span>" : "<span class='btn btn-success'> <i
                                                class='fa fa-check'></i> Validated</span>";
                                                ?>
                                                </td>
                                                <td style="text-align:center">
                                                    <button type="button"
                                                        onclick="{window.location.href = 'contract_signing.php?id=<?= $cid ?>&cn=<?= $row['contract_no'] ?>'}"
                                                        class="btn btn-warning btn-sml">Process
                                                        Loan <i class="fa fa-long-arrow-right"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            }?>
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