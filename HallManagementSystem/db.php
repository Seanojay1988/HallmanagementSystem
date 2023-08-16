<?php
require_once 'config.php';
//Replace the database connection details with your own credentials
$host = 'localhost';     // Database host (e.g., 'localhost' or '127.0.0.1')
$user = 'root'; // Database username
$pass = ''; // Database password
$dbname = 'hallmanagement'; // Database name

// Create a database connection
//$connection = mysqli_connect($host, $user, $pass, $dbname);
$conn = new mysqli($host, $user, $pass,$dbname);

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}




// $servername = "localhost";
// $username = "ha";
// $password = "";

// // Create connection
// $conn = new mysqli($servername, $username, $password);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
?>
