<?php
include('../config/conn.php');
include 'mvc/controller/class-autoload.cont.php';
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

    <title>LOAN MANAGEMENT SYSTEM - Loan Renewal Application</title>

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
                        <h1 class="page-header">Loan New Application</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading" align="right">
                                    <a href="reg_applicant_1.php">
                                        <button type="button" class="btn btn-success">
                                            <i class="fa fa-fw" aria-hidden="true" title="Copy to use user-plus">&#xf234</i> Add Applicant
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
                                                <th>CONTRACT NO.</th>
                                                <th>NAME</th>
                                                <!-- <th>GENDER</th>
                                                <th>CONTACT NO.</th> -->
                                                <!-- <th>ADDRESS</th> -->
                                                <!-- <th>BORROWING HISTORY</th> -->
                                                <th>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                //$sql ="SELECT c.*,l.remarks FROM clients c left join loan_applications l on l.client_id=c.client_id where  (l.remarks is null or l.remarks='paid') and (l.approval!=0 or l.approval is null) group by c.client_id ORDER BY last_name ASC";
                                                $sql = "SELECT * FROM applicants_personal ORDER BY lastname ASC";
                                                // $sql = "SELECT l.*,SUM(p.amount) as total_paid,
                                                // (SELECT CONCAT(lastname,', ',firstname,' ',middlename,' ',suffix) as name 
                                                // from applicants_personal where applicants_personal.applicant_code=l.client_id) as name 
                                                // from loan_applications l 
                                                // left join payments p on l.contract_no=p.contract_no 
                                                // where l.paid=0
                                                // order by l.application_date asc";
                                                $res = mysqli_query($con,$sql);
                                                    if(mysqli_num_rows($res) > 0){
                                                        while($row = mysqli_fetch_assoc($res)) {
                                                        $name = $row['lastname'].', '.$row['firstname'].' '.$row['middlename'];
                                                        // $suffix = $row['suffix'];
                                                        $cid = $row['applicant_code'];
                                                        $loan = new Loan(strval($cid));
                                                        //$name = $row['name'];?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $row['applicant_code'];?></td>
                                                <td><?php echo $name?></td>
                                                <!-- <td><?php //echo $row['gender'];?></td>
                                                <td><?php //echo $row['contact1'];?></td> -->
                                                <!-- <td><?php //echo $row['street1'].', '.$row['brgy1'].', '.$row['city1'] .''.$row['province1'];?> -->
                                                </td>
                                                <td style="text-align:center">
                                                    <div class="tooltip-demo">

                                                        <div class="panel-body">
                                                            <!-- Button trigger modal -->
                                                            
                                                            <button type="button" class="btn btn-primary btn-sml"
                                                                data-toggle="modal"
                                                                data-target="#myModal_<?php echo $cid?>">
                                                                NEW <i class="fa fa-long-arrow-right"
                                                                    aria-hidden="true" title="Copy to use save"></i>
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="myModal_<?php echo $cid?>"
                                                                tabindex="-1" role="dialog" data-backdrop="static"
                                                                aria-labelledby="myModalLabel" aria-hidden="true"
                                                                align="left">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">
                                                                                Proceed to New?</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-lg-12" align="right">
                                                                                    <!-- <div class=""> -->
                                                                                    <form
                                                                                        action="loan_application_1.php"
                                                                                        method="POST">
                                                                                        <input type="text"
                                                                                            name="loan_type"
                                                                                            value="RENEWAL" hidden>
                                                                                        <input type="text" name="id"
                                                                                            value="<?php echo $cid;?>"
                                                                                            hidden>
                                                                                        <input type="text" name="name"
                                                                                            value="<?php echo $name;?>"
                                                                                            hidden>
                                                                                        <a href="loan_application_1.php?id=<?php echo $cid?>"
                                                                                            class="btn btn-primary"
                                                                                            name="submit">
                                                                                            Proceed <i
                                                                                                class="fa fa-long-arrow-right"
                                                                                                aria-hidden="true"
                                                                                                title="Copy to use save"></i>
                                                                                        </a>
                                                                                    </form>
                                                                                    <!-- </div> -->
                                                                                </div>
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
                                                            <!-- /.modal -->
                                                        </div>
                                                        <?php
                                                                                                }
                                                                                                ?>
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