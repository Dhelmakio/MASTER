<?php
//Object-Oriented Mysqli DBConnection
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_DATABASE','amigo');

class DatabaseConnection
{
    public function connect()
    {
        $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);

        if($conn->connect_error)
        {
            die ("<h1>Database Connection Failed</h1>");
        }
        //echo "Database Connected Successfully";
        return $this->conn = $conn;
    }
}

//Procedural Mysqli DBConnection
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
?>