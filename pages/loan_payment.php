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

        <title>Lending System - Loan Payment</title>

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
                            <h1 class="page-header">Loan Payment</h1>
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
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>CONTRACT NO.</th>
                                                    <th>NAME</th>
                                                    <th>LOAN AMOUNT</th>
                                                    <th>MONTHLY AMORTIZATION</th>
                                                    <th>REMAINING BALANCE</th>
                                                    <th>DUE DATE</th>
                                                    <th>ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql ="SELECT * FROM loan_applications l left join clients c on c.client_id=l.client_id where remarks!='paid' and approval=1 order by l.date_flagged asc";
                                                    $res = mysqli_query($con,$sql);
                                                        if(mysqli_num_rows($res) > 0){
                                                            while($row = mysqli_fetch_assoc($res)) {
                                                                // $name = $row['last_name'].', '.$row['first_name'].' '.$row['middle_name'];
                                                                // $suffix = $row['suffix'];
                                                                $cid = $row['contract_no'];
                                                                $name = $row['last_name'].', '.$row['first_name'].' '.$row['suffix'].' '.$row['middle_name'].' '.$row['suffix'];
                                                                ?><tr class="odd gradeX">
                                                                    <td><?php echo $row['last_name'].', '.$row['first_name'].' '.$row['suffix'].' '.$row['middle_name'];?></td>
                                                                    <td><?php echo $row['gender'];?></td>
                                                                    <td><?php echo $row['mobile'];?></td>
                                                                    <td><?php echo $row['street'].', '.$row['brgy'];?></td>
                                                                    <td><?php echo $row['city'];?></td>
                                                                    <td><?php echo $row['province'];?></td>
                                                                    <td style="text-align:right">
                                                                        <div class="tooltip-demo">
                                                                                <a href="loan_payment_form.php?id=<?php echo $cid?>">
                                                                                    <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Proceed to payment">
                                                                                        <i class="fa fa-dollar" aria-hidden="true"></i> Pay
                                                                                    </button>
                                                                                </a>
                                                                            
                                                                            
                                                                        </div>
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
