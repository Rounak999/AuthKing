<?php
$servername = "172.31.160.1";
$username = "rounak";
$password = "rounak";
$dbname = "company";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "DB connection failed";
    die("Connection failed: " . $conn->connect_error);
}
?>
