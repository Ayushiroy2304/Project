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

// Fetch the employee data
$sql = "SELECT ID, Department,Name, Gender, Email, Phone FROM userdata WHERE ID = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Userdata</title>
</head>
<body>
  <style>
    body
    {
      background-color: #FCC8D1;
    }
.container {
      width: 300px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;-
      background-color: #FBFFB1;
    }

    .container label,
    .container input {
      display: block;
      margin-bottom: 10px;
      width: 70%;
      padding: 8px;
    }
    </style>

<div class="container">
  <h2>Edit Userdata</h2>

  <form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
    <label for="department">Department Name:</label>
    <input type="text" id="department" name="department" value="<?php echo $row['Department']; ?>"><br>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $row['Name']; ?>"><br>
    <label for="gender">Gender:</label>
    <input type="text" id="gender" name="gender" value="<?php echo $row['Gender']; ?>"><br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php echo $row['Email']; ?>"><br>
    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="<?php echo $row['Phone']; ?>"><br>

    <input type="submit" value="Update">
    </div>
  </form>
</body>
</html>
