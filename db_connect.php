<?php
$servername = "localhost"; // Change if using a remote server
$username = "root"; // Change if your MySQL has a different username
$password = ""; // Change if your MySQL has a password
$database = "healthDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
