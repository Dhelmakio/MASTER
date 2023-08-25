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
                        <h1 class="page-header">Validation | Credit Investigation</h1>
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
                                                <th class="text-center">CONTRACT NO.</th>
                                                <th class="text-center">NAME</th>
                                                <th class="text-center">PROMISSORY NOTE (PN)</th>
                                                <th class="text-center">APPLICATION DATE</th>
                                                <th class="text-center">LOCATION</th>
                                                <th class="text-center">INFORMATION</th>
                                                <th class="text-center">QUESTIONNAIRE (ACTIONS)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //LEFT or INNER?
                                                $sql ="SELECT * FROM loan_applications 
                                                INNER JOIN applicants_personal 
                                                ON applicants_personal.applicant_code = loan_applications.client_id WHERE loan_applications.ci_status = 0
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
                                                        $contract = $row['contract_no'];
                                                        //$cis = $row['ci_status'];
                                                ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $contract;?></td>
                                                <td><?php echo $row['lastname'].', '.$row['firstname'].' '.$row['suffix'].' '.$row['middlename'];?>
                                                </td>
                                                <td class="text-center">₱
                                                    <?php echo number_format($row['loan_amount'],2);?></td>
                                                <td class="text-center"><?php echo date('F d, Y',strtotime($adate));?>
                                                </td>
                                                <td style="text-align:center;"><a class="btn btn-primary"
                                                        href="<?php echo $row['map_url'];?>" target="_blank">View <i
                                                            class="fa fa-map"></i> </a></td>
                                                <td style="text-align:center;"><a class="btn btn-info"
                                                        href="registry_applicant_view.php?id=<?php echo $cid;?>">View <i
                                                            class="fa fa-eye"></i> </td>
                                                <td style="text-align:center">
                                                    <a
                                                        href="loan_credit_investigation_validate.php?contract=<?php echo $contract;?>">
                                                        <button type="button" class="btn btn-warning btn-sml">
                                                            Relative <i class="fa fa-long-arrow-right"
                                                                aria-hidden="true" title="Copy to use save"></i>
                                                        </button>
                                                    </a>
                                                    <a
                                                        href="loan_credit_investigation_validate_coworker.php?contract=<?php echo $contract;?>">
                                                        <button type="button" class="btn btn-warning btn-sml">
                                                            Co-worker <i class="fa fa-long-arrow-right"
                                                                aria-hidden="true" title="Copy to use save"></i>
                                                        </button>
                                                    </a>
                                                    
                                                    <?php
                                                    $code = "SELECT * FROM answers WHERE contract_no = '$contract'";
                                                    $code_res = mysqli_query($con,$code);
                                                    if(mysqli_num_rows($code_res) > 0){
                                                        while($row = mysqli_fetch_assoc($code_res)) {
                                                    ?>
                                                    <button type="button" class="btn btn-success btn-sml"
                                                        data-toggle="modal"
                                                        data-target="#recommend<?php echo $contract?>">
                                                        Recommendation
                                                    </button>
                                                    <?php
                                                        }
                                                    }else{
                                                    ?>
                                                    <button type="button" class="btn btn-success btn-sml"
                                                        data-toggle="modal" disabled
                                                        data-target="#recommend<?php echo $contract?>">
                                                        Recommendation
                                                    </button>
                                                    <?php 
                                                    }
                                                     ?>
                                                    <div class="modal fade" id="recommend<?php echo $contract?>"
                                                        tabindex="-1" role="dialog" data-backdrop="static"
                                                        aria-labelledby="myModalLabel" aria-hidden="true" align="left">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title text-center"
                                                                        id="myModalLabel">
                                                                        PASS OR FAIL?</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- <div class=""> -->
                                                                    <form
                                                                        action="loan_credit_investigation_pass.php?contract=<?php echo $contract?>"
                                                                        method="POST">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label><span style="color:red">*
                                                                                        </span>Remarks</label><br>
                                                                                    <input name="contract"
                                                                                        value="<?php echo $contract;?>"
                                                                                        type="hidden">
                                                                                    <textarea style="width: 315%;"
                                                                                        name="remarks" type="text"
                                                                                        class="form-control" col="10"
                                                                                        row="2" required
                                                                                        placeholder="Remarks"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <div class="text-center">
                                                                            <button class="btn btn-danger"
                                                                                name="submit_fail_remarks"
                                                                                type="submit">
                                                                                FAIL <i class="fa fa-times" aria-hidden="true"></i> 
                                                                            </button>
                                                                            <button class="btn btn-primary"
                                                                                name="submit_pass_remarks"
                                                                                type="submit">
                                                                                PASS <i class="fa fa-check" aria-hidden="true"></i>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                    <!-- </div> -->
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
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