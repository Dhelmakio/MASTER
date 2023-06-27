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
                                    <a href="reg_applicant_1.php">
                                        <button type="button" class="btn btn-success">
                                            <i class="fa fa-fw" aria-hidden="true" title="Copy to use user-plus">&#xf234</i> Add Applicant
                                        </button>
                                    </a>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>NAME</th>
                                                    <th>GENDER</th>
                                                    <th>CONTACT NO.</th>
                                                    <th>ADDRESS</th>
                                                    <th>CITY</th>
                                                    <th>PROVINCE</th>
                                                    <th>ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql ="SELECT * FROM clients ORDER BY last_name ASC";
                                                    $res = mysqli_query($con,$sql);
                                                        if(mysqli_num_rows($res) > 0){
                                                            while($row = mysqli_fetch_assoc($res)) {
                                                                // $name = $row['last_name'].', '.$row['first_name'].' '.$row['middle_name'];
                                                                // $suffix = $row['suffix'];
                                                                $cid = $row['client_id'];
                                                                $loan = new Loan($cid);
                                                                ?><tr class="odd gradeX">
                                                                    <td><?php echo $row['last_name'].', '.$row['first_name'].' '.$row['suffix'].' '.$row['middle_name'];?></td>
                                                                    <td><?php echo $row['gender'];?></td>
                                                                    <td><?php echo $row['mobile'];?></td>
                                                                    <td><?php echo $row['street'].', '.$row['brgy'];?></td>
                                                                    <td><?php echo $row['city'];?></td>
                                                                    <td><?php echo $row['province'];?></td>
                                                                    <td style="text-align:right">
                                                                        <div class="tooltip-demo">
                                                                            <?php
                                                                            //check if client info not complete
                                                                            $continue = "SELECT * FROM client_info where client_id = '$cid'";
                                                                            $cres = mysqli_query($con,$continue);
                                                                            $continue2 = "SELECT * FROM employer where client_id = '$cid'";
                                                                            $cres2 = mysqli_query($con,$continue2);
                                                                            if(mysqli_num_rows($cres) == 0){  
                                                                            ?>
                                                                        
                                                                            <a href="reg_applicant_exists.php?id=<?php echo $cid?>">
                                                                                <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Continue Family">
                                                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                                </button>
                                                                            </a><?php
                                                                                }
                                                                             if(mysqli_num_rows($cres2) == 0){
                                                                                ?>
                                                                        
                                                                            <a href="reg_applicant_employment_cont.php?id=<?php echo $cid?>">
                                                                                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Continue Employment">
                                                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                                                </button>
                                                                            </a><?php
                                                                             }   
                                                                             ?>
                                                                            <!-- <a href="reg_applicant_update.php?id=<?php echo $cid;?>">
                                                                                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                                    <i class="fa fa-pencil" aria-hidden="true"></i> 
                                                                                </button>
                                                                            </a> -->
                                                                            <?php
                                                                                if($loan->borrowingCount == 0){
                                                                            ?>
                                                                            <a href="loan_application_1.php?id=<?php echo $cid;?>">
                                                                                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="New Loan Application">
                                                                                    <i class="fa fa-money" aria-hidden="true"></i> 
                                                                                </button>
                                                                            </a>
                                                                            <?php }?>
                                                                            <?php
                                                                              //  if($_SESSION['access'] == 1){
                                                                            ?>
                                                                            <a href="reg_applicant_delete.php?id=<?php echo $cid;?>" onclick="return confirmDelete()">
                                                                                <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                                    <i class="fa fa-trash" aria-hidden="true"></i> 
                                                                                </button>
                                                                            </a>
                                                                            <?php //}?>
                                                                            <a href="reg_applicant_view.php?id=<?php echo $cid;?>">
                                                                                <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View">
                                                                                    <i class="fa fa-search" aria-hidden="true"></i> 
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


            var MD5 = function(d){var r = M(V(Y(X(d),8*d.length)));return r.toLowerCase()};function M(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function X(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function V(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function Y(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}

            function confirmDelete() {  
            var a = prompt("Confirm to Delete", "Enter Master Key");
            var result = MD5(a);  
            if (result == '582c2193b5208668118846af6e22c36c') {  
                alert("Successfully Deleted");
                return true;
            // document.getElementById("para").innerHTML = "Welcome to " + a;  
            }else{
                alert("Access Denied!");
                return false;
            }
            }  

            // function confirmDelete(){
            //     return confirm('Are you sure you want to delete account?');
            //     if(!con){

            //     }
            // }
        </script>

    </body>
</html>
