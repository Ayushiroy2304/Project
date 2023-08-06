
<?php
// Get the tag ID from the request
$tag_id = $_POST['tag_id'];

// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "rfid_tag";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Store the tag ID in the database
$sql = "INSERT INTO rfid tag (id) VALUES ('$id')";
if ($conn->query($sql) === TRUE) {
    echo "Tag ID stored in the database successfully.";
} else {
    echo "Error storing tag ID in the database: " . $conn->error;
}

$conn->close();
?>