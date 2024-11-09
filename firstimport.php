<?php
$servername = "localhost";
$username = "root";
$password = "2648";
$db_name="railres";

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
