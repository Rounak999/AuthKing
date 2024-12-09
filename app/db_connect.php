<?php
$servername = "db";
$username = "root";
$password = "newpassword";
$dbname = "company";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "DB connection failed";
    die("Connection failed: " . $conn->connect_error);
}
?>
