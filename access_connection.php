<?php

$mysqli = new mysqli("localhost", "root", "123456789");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$mysqli->select_db("accesst");

if ($mysqli->error) {
    die("Error selecting database: " . $mysqli->error);

}

echo "Connected successfully";
//echo "<script>location.replace('detailed.php')</script>";

?>