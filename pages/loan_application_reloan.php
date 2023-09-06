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

    <title>LOAN MANAGEMENT SYSTEM - Reloan Application</title>

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
                        <h1 class="page-header">Reloan Application</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <form action="" method="GET">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <input id="search_data" type="text" class="form-control" name="search" required
                                    autocomplete="off" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>"
                                    placeholder="Search Name">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>APPLICANT CODE</th>
                                                <th>NAME</th>
                                                <th>ADDRESS</th>
                                                <th class="text-center">CREDIT HISTORY</th>
                                                <th class="text-center">ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            function checkActiveLoan($name, $con){

                                                $sql = "SELECT approval AS active FROM applicants_personal 
                                                LEFT JOIN loan_applications 
                                                ON applicants_personal.applicant_code=loan_applications.client_id
                                                WHERE CONCAT(applicants_personal.firstname,applicants_personal.lastname,applicants_personal.middlename)
                                                LIKE '%$name%' AND loan_applications.approval = 0
                                                ORDER BY applicants_personal.lastname ASC ";
                                                $res = mysqli_query($con,$sql);
                                                return mysqli_num_rows($res) > 0;

                                            }

                                            function checkBorrowingHistory($name, $con){

                                                $sql = "SELECT COUNT(client_id) as history FROM loan_applications 
                                                LEFT JOIN applicants_personal 
                                                ON applicants_personal.applicant_code=loan_applications.client_id
                                                WHERE CONCAT(applicants_personal.firstname,applicants_personal.lastname,applicants_personal.middlename)
                                                LIKE '%$name%' AND loan_applications.paid = 1";
                                                $res = mysqli_query($con,$sql);
                                                
                                                return mysqli_fetch_assoc($res)['history'];

                                            }

                                            function checkOutstandingBalance($name, $con){

                                                $sql = "SELECT SUM(amount) as total_pay, loan_amount FROM payments
                                                LEFT JOIN loan_applications 
                                                ON loan_applications.contract_no = payments.contract_no
                                                LEFT JOIN applicants_personal 
                                                ON applicants_personal.applicant_code=loan_applications.client_id
                                                WHERE CONCAT(applicants_personal.firstname,applicants_personal.lastname,applicants_personal.middlename)
                                                LIKE '%$name%'";
                                                $res = mysqli_query($con,$sql);
                                                $row = mysqli_fetch_assoc($res);

                                                return floatval($row['loan_amount'] - $row['total_pay']);

                                            }

                                            if(isset($_GET['search'])){

                                                $search = $_GET['search'];
                                                    //$sql ="SELECT c.*,l.remarks FROM clients c left join loan_applications l on l.client_id=c.client_id where  (l.remarks is null or l.remarks='paid') and (l.approval!=0 or l.approval is null) group by c.client_id ORDER BY last_name ASC";
                                                    //$sql = "SELECT * FROM clients left join loan_applications on clients.client_id=loan_applications.client_id where loan_applications.paid=1 group by clients.client_id order by clients.last_name asc ";
                                                    
                                                    


                                                        $activeLoan = checkActiveLoan($search, $con);
                                                        $borrowHist = checkBorrowingHistory($search, $con);
                                                        $ob = checkOutstandingBalance($search, $con);

                                                        //  die('active ? ' . $activeLoan.' history ? ' .$borrowHist.'  ob ? '.$ob);

                                                        if($activeLoan == null && $borrowHist > 0 && $ob == 0){
                                                            $sql = "SELECT * FROM applicants_personal 
                                                        
                                                            WHERE CONCAT(firstname,lastname,middlename)
                                                            LIKE '%$search%'
                                                            ORDER BY lastname ASC";
                                                            $res = mysqli_query($con,$sql);
                                                        }else{
                                                            die('<script>alert("Not eligible or no data found.")</script>');
                                                        }

                                                        
                                                        


                                                        if(mysqli_num_rows($res) > 0){
                                                            while($row = mysqli_fetch_assoc($res)) {
                                                                // $name = $row['last_name'].', '.$row['first_name'].' '.$row['middle_name'];
                                                                // $suffix = $row['suffix'];
                                                                $cid = $row['applicant_code'];
                                                                $loan = new Loan($cid);
                                                                $name = $row['lastname'].', '.$row['firstname'].' '.$row['middlename'];
                                                               
                                                                ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $cid?></td>
                                                <td><?php echo $name?></td>
                                                <td><?php echo $row['brgy1'].', '.$row['city1'];?></td>
                                                <!-- <td class="text-center">
                                                    <?php //echo "₱ ".number_format(floatval($loan->outStandingBalance),2)?>
                                                </td> -->
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-sml"
                                                        data-toggle="modal" data-target="#credit<?php echo $cid?>">
                                                        View Credit History <i class="fa fa-eye" aria-hidden="true"
                                                            title="Copy to use save"></i></button>

                                                    <div class="modal fade" id="credit<?php echo $cid?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                                        align="left">
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

                                                                                    <?php
                                                                                        $query = "SELECT * FROM applicants_personal 
                                                                                        LEFT JOIN loan_applications 
                                                                                        ON applicants_personal.applicant_code=loan_applications.client_id 
                                                                                        WHERE loan_applications.client_id = '$cid' 
                                                                                        AND loan_applications.paid = 1
                                                                                        ORDER BY applicants_personal.lastname ASC";
                                                                                        $qry_res = mysqli_query($con,$query);
                                                                                            if(mysqli_num_rows($qry_res) > 0){
                                                                                                while($rows = mysqli_fetch_assoc($qry_res)){
                                                                                                    
                                                                                    ?>
                                                                                    <td><?php echo $rows['contract_no']?>
                                                                                    </td>
                                                                                    <td><?php echo $rows['loan_type']?>
                                                                                    </td>
                                                                                    <td class="text-center">₱
                                                                                        <?php echo number_format($rows['loan_amount'],2);?>
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        <?php //echo "₱ ".number_format(floatval($loan->outStandingBalance),2)
                                                                                                    echo "₱ ".number_format(floatval($loan->outStandingBalance),2)
                                                                                                    ?>
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
                                                <td class="text-center">
                                                    <a
                                                        href="registry_applicant_update.php?id=<?php echo $row['applicant_code'];?>">
                                                        <button type="button" class="btn btn-success"
                                                            data-toggle="tooltip" data-placement="top" title="Update">
                                                            Update Info
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                        </button>
                                                    </a>
                                                    <!-- Button trigger modal  Ako gi tangtang = [AND paid=0] sa query  -->

                                                    <button type="button" class="btn btn-primary btn-sml"
                                                        data-toggle="modal" data-target="#myModal_<?php echo $cid?>">
                                                        Apply Loan <i class="fa fa-long-arrow-right" aria-hidden="true"
                                                            title="Copy to use save"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myModal_<?php echo $cid?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                                        align="left">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        Proceed to Reloan Application?</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12" align="right">
                                                                            <!-- <div class=""> -->
                                                                            <form action="loan_application_3.php"
                                                                                method="POST">
                                                                                <input type="text" name="loan_type"
                                                                                    value="RELOAN" hidden>
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
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.modal -->
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            }else{
                                                echo '<script>alert("No data found.")</script>';
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

    window.onload = function() {
        document.getElementById('search_data').value = '';
    }
    </script>

</body>

</html>