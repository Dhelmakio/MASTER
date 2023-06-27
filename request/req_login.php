<?php
session_start();

require_once('../controller/control_login.php');
require_once('../controller/user_log.php');

$req = new Login();
$log = new User();

$result = $req->auth_login($_POST['username'], $_POST['password']);

if($result == true){
    $id = $req->setSession($_POST['username'], 'user_id');
    $name = $req->setSession($_POST['username'], 'name');
    $log->login($id, $name);
}

echo json_encode(array("result" => $result));

// if ( isset($_POST['username'], $_POST['password']) ) {
// 	// Could not get the data that should have been sent.
// 	// exit('Please fill both the username and password fields!');

//     // echo 'store result';
//     // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
//     if ($stmt = $con->prepare('SELECT user_id, password, name FROM users WHERE username = ?')) {
//         // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
//         $stmt->bind_param('s', $_POST['username']);
//         $stmt->execute();
//         // Store the result so we can check if the account exists in the database.
//         $stmt->store_result();
        
//         if ($stmt->num_rows > 0) {
//             $stmt->bind_result($id, $password, $name);
//             $stmt->fetch();
//             // User exists, now we verify the password.
//             // Note: remember to use password_hash in your registration file to store the hashed passwords.
//             if (password_verify($_POST['password'], $password)) {
//             // if ($_POST['password'] === $password) {
//                 // Verification success! User has logged-in!
//                 // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
//                 session_regenerate_id();
//                 $_SESSION['loggedin'] = TRUE;
//                 $_SESSION['name'] = $name;
//                 $_SESSION['user_id'] = $id;
//                 // echo 'Welcome ' . $_SESSION['name'] . '!';

//                 $log = "INSERT into activity_logs (user_id,name,activity) values ('$id','$name','Logged in')";
//                 mysqli_query($con,$log);

//                 header("location: dashboard.php");
//             } else {
//                 // Incorrect password
//                 header("location: login.php?error");
//             }
//         } else {
//             // Incorrect username
//             header("location: login.php?error");
//         }

//         $stmt->close();
//     }
// }

?>