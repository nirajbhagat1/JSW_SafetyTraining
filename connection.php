<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safety_test";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the charset to ensure proper character encoding
$conn->set_charset("utf8");

// You can uncomment the following line if you want to display a success message
// echo "Connected successfully";
?>
