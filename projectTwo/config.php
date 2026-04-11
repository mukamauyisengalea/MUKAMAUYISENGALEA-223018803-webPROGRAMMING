<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";
$port = 3307; // Updated port

// Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
