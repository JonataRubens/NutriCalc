<?php
// Database configuration
$host = "db"; // Database host
$port = "3306"; // Database port 
$username = "admin";
$password = "admin"; 
$database = "nutricalc"; 




// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set
$conn->set_charset("utf8");
?>
