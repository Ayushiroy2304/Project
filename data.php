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

// Fetch data from the employees table
$sql = "SELECT id, department,name, gender, email, phone FROM userdata";
$result = $conn->query($sql);

// Store the data in an array
$data = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = [
      'id' => $row['id'],
      'department' => $row['department'],
      'name' => $row['name'],
      'gender' => $row['gender'],
      'email' => $row['email'],
      'phone' => $row['phone']
    ];
  }
}

// Close the database connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>







 