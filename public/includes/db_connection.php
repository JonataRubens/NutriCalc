<?php
function getDbConnection() {
    $host = "db";
    $port = "3306";
    $username = "admin";
    $password = "admin";
    $database = "nutricalc";

    $conn = new mysqli($host, $username, $password, $database, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
    return $conn;
}
?>
