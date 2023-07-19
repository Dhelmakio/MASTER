<?php
session_start();


if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
$id;
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('location:setting_notarial.php');
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

    <title>Lending System - Applicant Information Registry</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">
    <link href="../css/multi-step.css" rel="stylesheet">
    <link href="../css/toast/beautyToast.css" rel="stylesheet">
    <link href="../css/loader.css" rel="stylesheet">

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
                        <h1 class="page-header">Update Applicant Information Registry</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel tabbed-panel panel-default">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <!-- Page 1 -->
                                    <div class="tab-pane fade in active" id="tab-default-1">
                                        <!-- <h3>STEP 1: Personal Information I</h3> -->
                                        <div class="panel panel-primary">
                                            <!-- <div class="panel-heading">
                                                Personal Information
                                            </div> -->
                                            <div class="panel-body">
                                                <!-- MultiStep Form -->
                                                <div class="container-fluid" id="grad1">
                                                    <div class="row justify-content-center mt-0">
                                                        <div class="col-12">
                                                            <div class="card">
                                                                <div class="row">
                                                                    <?php
                                                                    include '../config/conn.php';
                                                                    $sql = "SELECT * FROM  fees";
                                                                    $result = mysqli_query($con, $sql);
                                                                    foreach($result as $row){
                                                                    ?>
                                                                    <div class="col-lg-12 mx-0">
                                                                        <form id="msform" action="../reg_notarial.php">
                                                                            <!-- fieldsets -->
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>Notarial Fee</label>
                                                                                    <input
                                                                                        class="form-control text-right"
                                                                                        name="notarial"
                                                                                        value="<?php echo $row['notarial_fee'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <a href="setting_notarial.php" id="submit_add"
                                                                                class="btn-default btn"
                                                                                style="margin-left: 10px;">
                                                                                <i class="fa fa-arrow-left"></i>
                                                                                Cancel</a>
                                                                                
                                                                            <button type="button" name="submit_add"
                                                                                id="submit_notarial" class="btn-primary btn"
                                                                                style="margin-left: 10px;">
                                                                                Save <i class="fa fa-save"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.row (nested) -->
                                            </div>
                                            <!-- /.panel-body -->
                                        </div>
                                        <!-- /.panel -->

                                    </div>

                                    <!-- <div class="tab-pane fade" id="tab-default-3">Page 3</div>
                                        <div class="tab-pane fade" id="tab-default-4">Page 4</div>
                                        <div class="tab-pane fade" id="tab-default-5">Page 5</div> -->
                                </div>
                            </div>
                        </div>
                        <!-- /.panel -->
                    </div>
                    <div class="col-lg-12">

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/startmin.js"></script>
    <script src="../js/multi-step.js"></script>
    <script src="../css/toast/beautyToast.js"></script>
    <script>
    function submit() {
        $.ajax({
            type: 'POST',
            url: '../request/reg_update.php',
            data: $('form').serialize(),
            dataType: 'json',
            success: function(response) {

                setTimeout(() => {

                    beautyToast.success({
                        title: '',
                        message: response.message,
                        darkTheme: false,
                        iconColor: 'green',
                        iconWidth: 24,
                        iconHeight: 24,
                        animationTime: 100,
                    });

                    setTimeout(() => {
                        window.location.replace(
                            `loan_application_1.php?id=${response.code}`);
                    }, 2500);
                }, 2000);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }
    </script>

</body>

</html>
<?php
}else{
    header('location: index.php');
}
?>