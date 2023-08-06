<?php
// Retrieve form data
$id = $_POST['id'];
$department = $_POST['department'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Connect to the database
$servername = "localhost";
$username = "root"; // Change if you have a different username
$password = "123456789"; // Change if you have set a password
$dbname = "user_registration"; // Change if you used a different database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the table
$sql = "INSERT INTO userdata (id,department, name, gender, email, phone) VALUES ('$id','$department', '$name', '$gender', '$email', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Welcome! You registration is successful')</script>";
    echo "<script>location.replace('usermanagement.php')</script>";
} else {
    echo "Error inserting data: " . $conn->error;
}

$conn->close();
?>




