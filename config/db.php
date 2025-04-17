<?php
// Database credentials
$servername = "localhost";  // Usually 'localhost'
$username = "root";         // Default username for XAMPP/MAMP is 'root'
$password = "root";             // Default password is empty
$dbname = "park_mate";      // Your database name (make sure this exists)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
