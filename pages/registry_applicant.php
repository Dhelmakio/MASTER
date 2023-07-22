<?php
session_start();

include('../config/conn.php');
include('../controller/reg_app.php');
$applicant = new Registry();
if(isset($_POST['delete'])){
    $applicant->deletePer($_POST['id'], "archive");
    unset($_POST['delete']);
    unset($_POST['id']);;
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

    <title>LOAN MANAGEMENT SYSTEM - Applicant Information Registry</title>

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
                            <div class="panel-heading" align="right">
                                <!-- Clients -->
                                <a href="registry_application.php">
                                    <button type="button" class="btn btn-success">
                                        <i class="fa fa-fw" aria-hidden="true" title="Copy to use user-plus">&#xf234</i>
                                        Add Applicant
                                    </button>
                                </a>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>NAME</th>
                                                <th>GENDER</th>
                                                <th>CONTACT NO.</th>
                                                <th>BARANGAY</th>
                                                <th>CITY</th>
                                                <th>PROVINCE</th>
                                                <th class="text-center">ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $applicant = new Registry();
                                                $result = $applicant->display("applicants_personal");                                
                                                foreach($result as $display){                                                         
                                            ?>
                                            <tr class="even gradeC">
                                                <td><?php echo $display['lastname'].', '.$display['firstname'].' '.$display['suffix'].' '.$display['middlename'];?>
                                                </td>
                                                <td><?php echo $display['gender'];?></td>
                                                <td><?php echo $display['contact1'];?></td>
                                                <td><?php echo $display['brgy1'];?></td>
                                                <td><?php echo $display['city1'];?></td>
                                                <td><?php echo $display['province1'];?></td>
                                                <td style="text-align:center">
                                                    <div class="tooltip-demo">
                                                        <a
                                                            href="registry_applicant_view.php?id=<?php echo $display['applicant_code'];?>">
                                                            <button type="button" class="btn btn-info"
                                                                data-toggle="tooltip" data-placement="top" title="View">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </button>
                                                        </a>
                                                        <a
                                                            href="registry_applicant_update.php?id=<?php echo $display['applicant_code'];?>">
                                                            <button type="button" class="btn btn-success"
                                                                data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            </button>
                                                        </a>
                                                        <!-- <button data-target="#modal-<?=  $display['applicant_code'] ?>"
                                                            title="Delete" type="button" data-placement="top"
                                                            data-toggle="modal" class="btn btn-danger"><i
                                                                class="fa fa-trash-o"></i>
                                                        </button> -->
                                                        
                                                            <button data-target="#modal-<?= $display['applicant_code'] ?>" type="button" class="btn btn-warning"
                                                                data-toggle="modal" data-placement="top" title="Archive">
                                                                <!-- <i class="fa fa-file-text-o" aria-hidden="true"></i> -->
                                                                <i class="fa fa-fw" aria-hidden="true" title="Copy to use archive">&#xf187</i>
                                                            </button>

                                                            <!-- delete modal -->
                                                            <div class="modal fade text-left"
                                                                id="modal-<?=  $display['applicant_code'] ?>" tabindex="-1"
                                                                role="dialog" aria-labelledby="myModalLabel"
                                                                aria-hidden="true" data-backdrop="static">
                                                                <div class="modal-dialog modal-md" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <p>
                                                                                <center><i class="fa fa-fw fa-5x"
                                                                                        style="color:#d9534f;"
                                                                                        aria-hidden="true" title="Copy to use archive">&#xf187</i>
                                                                                </center>
                                                                                <center>
                                                                                    <h5>Save to archive?</h5>
                                                                                </center>

                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer" style="padding: 5px;">
                                                                            <form action="#" method="post">
                                                                                <button type="button"
                                                                                    class="btn btn-default text-small"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                                <input type="hidden" name="id"
                                                                                    value="<?=  $display['applicant_code'] ?>">
                                                                                <button type="submit" name="delete"
                                                                                    class="btn btn-danger text-small">Yes</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                            </div>
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