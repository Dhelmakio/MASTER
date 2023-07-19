<?php
session_start();

include('../config/conn.php');
include('../controller/reg_app.php');
$applicant = new Registry();
// if(isset($_POST['delete'])){
//     $applicant->deletePer($_POST['id'], "archive");
//     unset($_POST['delete']);
//     unset($_POST['id']);;
// }
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

    <title>LOAN MANAGEMENT SYSTEM - Settings Notarial Fee</title>

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
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading" align="right">
                               
                                <a href="registry_application.php">
                                    <button type="button" class="btn btn-success">
                                        <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                                        Update Notarial Fee
                                    </button>
                                </a>
                            </div> -->
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Notarial Fee</th>
                                                <th class="text-center">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $settings = new Registry();
                                                $result = $settings->display("fees");                                
                                                foreach($result as $display){                                                         
                                            ?>
                                            <tr class="even gradeC">
                                                <td class="text-center">
                                                    <?php  echo  "₱ ".number_format(floatval($display['notarial_fee']),2)??null;?>
                                                </td>
                                                <td class="text-center">
                                                    <a
                                                        href="setting_notarial_update.php?id=<?php echo $display['notarial_id'];?>">
                                                        <button type="button" class="btn btn-info" data-toggle="tooltip"
                                                            data-placement="top" title="Update  ">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i> Update
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
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
<?php
}else{
    header('location: index.php');
}
?>