<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "user_registration";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the employee ID from the URL parameter
$id = $_GET['id'];

// Delete the employee from the database
$sql = "DELETE FROM userdata WHERE ID = '$id'";
$conn->query($sql);

// Close the database connection
$conn->close();
?>
