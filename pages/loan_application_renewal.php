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
                        <h1 class="page-header">Loan Renewal Application</h1>
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
                                                <th>ADDRESS</th>
                                                <th class="text-center">OUTSTANDING BALANCE</th>
                                                <th class="text-center">CREDIT HISTORY</th>
                                                <th class="text-center">ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "SELECT * FROM applicants_personal
                                                LEFT JOIN loan_applications
                                                ON applicants_personal.applicant_code = loan_applications.client_id
                                                ORDER BY loan_applications.application_date ASC";
                                                $res = mysqli_query($con,$sql);
                                                    if(mysqli_num_rows($res) > 0){
                                                        while($row = mysqli_fetch_assoc($res)) {
                                                        // $name = $row['last_name'].', '.$row['first_name'].' '.$row['middle_name'];
                                                        // $suffix = $row['suffix'];
                                                        $cid = $row['client_id'];
                                                        $loan = new Loan(strval($cid));
                                                        $name = $row['lastname'].', '.$row['firstname'].' '.$row['middlename'] .' '.$row['suffix'];
                                                        $cont_no = $row['contract_no'];
                                                ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $cont_no;?></td>
                                                <td><?php echo $name;?></td>
                                                
                                                <!--<td><?php //echo $row['contact1'];?></td> -->
                                                <td><?php echo $row['brgy1'].', '.$row['city1'] .', '.$row['province1'];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo "₱ ".number_format(floatval($loan->outStandingBalance),2)?>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-sml"
                                                        data-toggle="modal" data-target="#credit<?php echo $cont_no?>">
                                                        View Credit History <i class="fa fa-eye" aria-hidden="true"
                                                            title="Copy to use save"></i></button>
                                                    <div class="modal fade" id="credit<?php echo $cont_no?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                        aria-hidden="true" align="left">
                                                        <div class="modal-dialog modal-lg" style="width:60%"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-hidden="true">&times;</button>
                                                                    <center>
                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                            Credit History</h4>
                                                                    </center>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-1">
                                                                            <h4>Name:</h4>
                                                                        </div>
                                                                        <div class="col-lg-5">
                                                                            <h4>
                                                                                <b><?php echo $name ?></b>
                                                                            </h4>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <h4>Borrowing History:</h4>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <h4><b><?php echo $loan->borrowingHistCount;?></b>
                                                                            </h4>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <h4>Employee Status:</h4>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <h4>
                                                                                <b><?php echo $loan->clientEmpStatus; ?></b>
                                                                            </h4>
                                                                        </div>
                                                                    </div><br><br>
                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-striped table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>CONTRACT NO.</th>
                                                                                    <th>LOAN TYPE</th>
                                                                                    <th class="text-center">PRINCIPAL
                                                                                    </th>
                                                                                    <!-- <th class="text-center">AMOUNT PAID</th> -->
                                                                                    <th class="text-center">OUSTANDING
                                                                                        BALANCE</th>
                                                                                    <th class="text-center">STATUS</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td><?php echo $row['contract_no']?>
                                                                                    </td>
                                                                                    <td><?php echo $row['loan_type']?>
                                                                                    </td>
                                                                                    <td class="text-center">₱
                                                                                        <?php echo number_format($row['loan_amount'],2);?>
                                                                                    </td>
                                                                                    <?php
                                                                                        $query = "SELECT * FROM applicants_personal 
                                                                                        LEFT JOIN loan_applications 
                                                                                        ON applicants_personal.applicant_code=loan_applications.client_id 
                                                                                        LEFT JOIN payments 
                                                                                        ON payments.contract_no = loan_applications.contract_no 
                                                                                        WHERE loan_applications.contract_no = '$cont_no'
                                                                                        ORDER BY applicants_personal.lastname ASC";
                                                                                        $qry_res = mysqli_query($con,$query);
                                                                                            if(mysqli_num_rows($qry_res) > 0){
                                                                                                while($rows = mysqli_fetch_assoc($qry_res)){
                                                                                                    $get_name = $rows['lastname'].', '.$rows['firstname'].' '.$rows['middlename'];
                                                                                    ?>
                                                                                    <!-- <td class="text-center">₱
                                                                                        <?php //echo number_format($rows['amount'],2)?>
                                                                                    </td> -->
                                                                                    <td class="text-center">
                                                                                        <?php echo "₱ ".number_format(floatval($loan->outStandingBalance),2)?>
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        <?php
                                                                                        if($rows['loan_status'] == 1){
                                                                                            echo '<button class="btn btn-success"> Active <i class="fa fa-check"></i>
                                                                                            </button>';
                                                                                        }else{
                                                                                            echo '<button class="btn btn-warning"> Paid <i class="fa fa-thumbs-o-up"></i>
                                                                                            </button>';
                                                                                        }
                                                                                    ?>
                                                                                    </td>
                                                                                    <?php
                                                                                      }
                                                                                    }
                                                                            ?>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                </td>
                                                <td style="text-align:center">
                                                    <!-- Button trigger modal -->
                                                    <?php
                                                                //kani diri tangtangon paid=1 kay paid or not pwede ra mag renewal nakalimot kos policy HAHAHHAHA basta naa ra to policy sa renewal
                                                                // $check = "SELECT * FROM loan_applications WHERE client_id='$cid' and paid=1 ";
                                                                $check = "SELECT * FROM loan_applications WHERE client_id='$cid'";
                                                                $rescheck = mysqli_query($con,$check);
                                                                    if(mysqli_num_rows($rescheck) > 0){ 
                                                            ?>
                                                    <button type="button" class="btn btn-primary btn-sml"
                                                        data-toggle="modal" data-target="#myModal_<?php echo $cid?>">
                                                        Apply For Renewal <i class="fa fa-long-arrow-right"
                                                            aria-hidden="true" title="Copy to use save"></i>
                                                    </button>
                                                    <?php
                                                                }
                                                            ?>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myModal_<?php echo $cid?>" tabindex="-1"
                                                        role="dialog" data-backdrop="static"
                                                        aria-labelledby="myModalLabel" aria-hidden="true" align="left">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        Proceed to Renewal?</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12" align="right">
                                                                            <!-- <div class=""> -->
                                                                            <form action="loan_application_2.php"
                                                                                method="POST">
                                                                                <input type="text" name="loan_type"
                                                                                    value="RENEWAL" hidden>
                                                                                <input type="text" name="id"
                                                                                    value="<?php echo $cid;?>" hidden>
                                                                                <input type="text" name="name"
                                                                                    value="<?php echo $name;?>" hidden>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary"
                                                                                    name="submit">
                                                                                    Proceed <i
                                                                                        class="fa fa-long-arrow-right"
                                                                                        aria-hidden="true"
                                                                                        title="Copy to use save"></i>
                                                                                </button>
                                                                            </form>
                                                                            <!-- </div> -->
                                                                        </div>
                                                                        <div class="col-lg-6">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                </td>
                                        </tbody>
                                        <?php  
                                            }
                                        }
                                    ?>
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