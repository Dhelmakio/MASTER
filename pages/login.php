<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'amigo';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ( isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	// exit('Please fill both the username and password fields!');

// echo 'store result';
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    if ($stmt = $con->prepare('SELECT user_id, password, name, access_level FROM users WHERE username = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        // 1-superadmin 2-approver 3-registry 4-collection 5-Credit Investigator
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password, $name, $access);
            $stmt->fetch();
            // User exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.
            if (password_verify($_POST['password'], $password)) {
            // if ($_POST['password'] === $password) {
                // Verification success! User has logged-in!
                // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $name;
                $_SESSION['user_id'] = $id;
                $_SESSION['access'] = $access;
                // echo 'Welcome ' . $_SESSION['name'] . '!';

                $log = "INSERT into activity_logs (user_id,name,activity) values ('$id','$name','Logged in')";
                mysqli_query($con,$log);

                header("location: index.php");
            } else {
                // Incorrect password
                header("location: login.php?error");
            }
        } else {
            // Incorrect username
            header("location: login.php?error");
        }


        $stmt->close();
    }
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

        <title>LOAN MANAGEMENT SYSTEM | LOGIN</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

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
        
        

        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="height:100px;width:100%;" align="center">
                        <?php
                            if(isset($_GET['error'])){
                                ?>
                                    <div class="alert alert-danger alert-dismissible error" id="error">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Invalid Username and/or Password. Please try again.
                                            <!-- <a href="#" class="alert-link">Alert Link</a>.  -->
                                    </div>
                                <?php
                            }
                        ?>
                </div>
                <div class="col-lg-12" align="center">
                    <!-- <h1>AMIGO</h1> -->
                    <img src="../assets/amigo_logo.png" style="width:250px; height:auto;">
                    <h3>LOAN MANAGEMENT SYSTEM</h3>
                    <!-- <i><b><b></i><BR> -->
                    <!-- <i>ATTENDANCE MONITORING SYSTEM</i> -->
                </div>
                <div class="col-md-4 col-md-offset-4">
                
                    <div class="login-panel panel panel-default">
                        
                        <div class="panel-heading">
                            <center><h3 class="panel-title">LOGIN</h3></center>
                        </div>
                        
                        <div class="panel-body">
                        
                            <form role="form" action="#" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" name="username" type="text" autocomplete="off" value="" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-lg btn-primary btn-block" type="submit" value="LOGIN">
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <!-- <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

    </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- <div id='plsme'>Loading... Please Wait</div> -->
<script>
$(document).ready(function() {
  $('#error').fadeOut(5000); // 5 seconds x 1000 milisec = 5000 milisec
});
</script>